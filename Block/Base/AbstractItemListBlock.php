<?php
/**
 * EventPhotos.
 *
 * @copyright Ralf Koester (RK)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Ralf Koester <ralf@familie-koester.de>.
 * @link http://k62.de
 * @link http://zikula.org
 * @version Generated by ModuleStudio 1.3.0 (https://modulestudio.de).
 */

namespace RK\EventPhotosModule\Block\Base;

use Zikula\BlocksModule\AbstractBlockHandler;
use Zikula\Core\AbstractBundle;
use RK\EventPhotosModule\Helper\FeatureActivationHelper;
use RK\EventPhotosModule\Block\Form\Type\ItemListBlockType;

/**
 * Generic item list block base class.
 */
abstract class AbstractItemListBlock extends AbstractBlockHandler
{
    /**
     * List of object types allowing categorisation.
     *
     * @var array
     */
    protected $categorisableObjectTypes;
    
    /**
     * ItemListBlock constructor.
     *
     * @param AbstractBundle $bundle An AbstractBundle instance
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(AbstractBundle $bundle)
    {
        parent::__construct($bundle);
    
        $this->categorisableObjectTypes = ['album', 'albumItem'];
    }
    
    /**
     * Display the block content.
     *
     * @param array $properties The block properties
     *
     * @return string
     */
    public function display(array $properties = [])
    {
        // only show block content if the user has the required permissions
        if (!$this->hasPermission('RKEventPhotosModule:ItemListBlock:', "$properties[title]::", ACCESS_OVERVIEW)) {
            return '';
        }
    
        // set default values for all params which are not properly set
        $defaults = $this->getDefaults();
        $properties = array_merge($defaults, $properties);
    
        $featureActivationHelper = $this->get('rk_eventphotos_module.feature_activation_helper');
        if ($featureActivationHelper->isEnabled(FeatureActivationHelper::CATEGORIES, $properties['objectType'])) {
            $properties = $this->resolveCategoryIds($properties);
        }
    
        $controllerHelper = $this->get('rk_eventphotos_module.controller_helper');
        $contextArgs = ['name' => 'list'];
        if (!isset($properties['objectType']) || !in_array($properties['objectType'], $controllerHelper->getObjectTypes('block', $contextArgs))) {
            $properties['objectType'] = $controllerHelper->getDefaultObjectType('block', $contextArgs);
        }
    
        $objectType = $properties['objectType'];
    
        $repository = $this->get('rk_eventphotos_module.entity_factory')->getRepository($objectType);
    
        // create query
        $orderBy = $this->get('rk_eventphotos_module.model_helper')->resolveSortParameter($objectType, $properties['sorting']);
        $qb = $repository->getListQueryBuilder($properties['filter'], $orderBy);
    
        // fetch category registries
        $catProperties = null;
        if (in_array($objectType, $this->categorisableObjectTypes)) {
            if ($featureActivationHelper->isEnabled(FeatureActivationHelper::CATEGORIES, $properties['objectType'])) {
                $categoryHelper = $this->get('rk_eventphotos_module.category_helper');
                $catProperties = $categoryHelper->getAllProperties($objectType);
                // apply category filters
                if (is_array($properties['catIds']) && count($properties['catIds']) > 0) {
                    $qb = $categoryHelper->buildFilterClauses($qb, $objectType, $properties['catIds']);
                }
            }
        }
    
        // get objects from database
        $currentPage = 1;
        $resultsPerPage = $properties['amount'];
        $query = $repository->getSelectWherePaginatedQuery($qb, $currentPage, $resultsPerPage);
        try {
            list($entities, $objectCount) = $repository->retrieveCollectionResult($query, true);
        } catch (\Exception $exception) {
            $entities = [];
            $objectCount = 0;
        }
    
        if ($featureActivationHelper->isEnabled(FeatureActivationHelper::CATEGORIES, $objectType)) {
            $entities = $this->get('rk_eventphotos_module.category_helper')->filterEntitiesByPermission($entities);
        }
    
        // set a block title
        if (empty($properties['title'])) {
            $properties['title'] = $this->__('RKEventPhotosModule items');
        }
    
        $template = $this->getDisplayTemplate($properties);
    
        $templateParameters = [
            'vars' => $properties,
            'objectType' => $objectType,
            'items' => $entities
        ];
        if ($featureActivationHelper->isEnabled(FeatureActivationHelper::CATEGORIES, $properties['objectType'])) {
            $templateParameters['properties'] = $properties;
        }
    
        $templateParameters = $this->get('rk_eventphotos_module.controller_helper')->addTemplateParameters($properties['objectType'], $templateParameters, 'block', []);
    
        return $this->renderView($template, $templateParameters);
    }
    
    /**
     * Returns the template used for output.
     *
     * @param array $properties The block properties
     *
     * @return string the template path
     */
    protected function getDisplayTemplate(array $properties = [])
    {
        $templateFile = $properties['template'];
        if ($templateFile == 'custom' && null !== $properties['customTemplate'] && $properties['customTemplate'] != '') {
            $templateFile = $properties['customTemplate'];
        }
    
        $templateForObjectType = str_replace('itemlist_', 'itemlist_' . $properties['objectType'] . '_', $templateFile);
        $templating = $this->get('templating');
    
        $templateOptions = [
            'Block/' . $templateForObjectType,
            'Block/' . $templateFile,
            'Block/itemlist.html.twig'
        ];
    
        $template = '';
        foreach ($templateOptions as $templatePath) {
            if ($templating->exists('@RKEventPhotosModule/' . $templatePath)) {
                $template = '@RKEventPhotosModule/' . $templatePath;
                break;
            }
        }
    
        return $template;
    }
    
    /**
     * Returns the fully qualified class name of the block's form class.
     *
     * @return string Template path
     */
    public function getFormClassName()
    {
        return ItemListBlockType::class;
    }
    
    /**
     * Returns any array of form options.
     *
     * @return array Options array
     */
    public function getFormOptions()
    {
        $objectType = 'album';
    
        $request = $this->get('request_stack')->getCurrentRequest();
        if ($request->attributes->has('blockEntity')) {
            $blockEntity = $request->attributes->get('blockEntity');
            if (is_object($blockEntity) && method_exists($blockEntity, 'getProperties')) {
                $blockProperties = $blockEntity->getProperties();
                if (isset($blockProperties['objectType'])) {
                    $objectType = $blockProperties['objectType'];
                } else {
                    // set default options for new block creation
                    $blockEntity->setProperties($this->getDefaults());
                }
            }
        }
    
        return [
            'object_type' => $objectType,
            'is_categorisable' => in_array($objectType, $this->categorisableObjectTypes),
            'category_helper' => $this->get('rk_eventphotos_module.category_helper'),
            'feature_activation_helper' => $this->get('rk_eventphotos_module.feature_activation_helper')
        ];
    }
    
    /**
     * Returns the template used for rendering the editing form.
     *
     * @return string Template path
     */
    public function getFormTemplate()
    {
        return '@RKEventPhotosModule/Block/itemlist_modify.html.twig';
    }
    
    /**
     * Returns default settings for this block.
     *
     * @return array The default settings
     */
    protected function getDefaults()
    {
        return [
            'objectType' => 'album',
            'sorting' => 'default',
            'amount' => 5,
            'template' => 'itemlist_display.html.twig',
            'customTemplate' => null,
            'filter' => ''
        ];
    }
    
    /**
     * Resolves category filter ids.
     *
     * @param array $properties The block properties
     *
     * @return array The updated block properties
     */
    protected function resolveCategoryIds(array $properties = [])
    {
        if (!isset($properties['catIds'])) {
            $categoryHelper = $this->get('rk_eventphotos_module.category_helper');
            $primaryRegistry = $categoryHelper->getPrimaryProperty($properties['objectType']);
            $properties['catIds'] = [$primaryRegistry => []];
        } elseif (!is_array($properties['catIds'])) {
            $properties['catIds'] = explode(',', $properties['catIds']);
        }
    
        return $properties;
    }
}
