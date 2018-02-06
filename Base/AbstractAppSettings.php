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

namespace RK\EventPhotosModule\Base;

use Symfony\Component\Validator\Constraints as Assert;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use RK\EventPhotosModule\Validator\Constraints as EventPhotosAssert;

/**
 * Application settings class for handling module variables.
 */
abstract class AbstractAppSettings
{
    /**
     * @var VariableApiInterface
     */
    protected $variableApi;
    
    /**
     * The maximum height of a row in the image album.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $rowHeight
     */
    protected $rowHeight = 190;
    
    /**
     * The amount of albums shown per page
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $albumEntriesPerPage
     */
    protected $albumEntriesPerPage = 10;
    
    /**
     * Whether to add a link to albums of the current user on his account page
     *
     * @Assert\NotNull()
     * @Assert\Type(type="bool")
     * @var boolean $linkOwnAlbumsOnAccountPage
     */
    protected $linkOwnAlbumsOnAccountPage = true;
    
    /**
     * The amount of album items shown per page
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $albumItemEntriesPerPage
     */
    protected $albumItemEntriesPerPage = 10;
    
    /**
     * Whether to add a link to album items of the current user on his account page
     *
     * @Assert\NotNull()
     * @Assert\Type(type="bool")
     * @var boolean $linkOwnAlbumItemsOnAccountPage
     */
    protected $linkOwnAlbumItemsOnAccountPage = true;
    
    /**
     * Whether to enable shrinking huge images to maximum dimensions. Stores downscaled version of the original image.
     *
     * @Assert\NotNull()
     * @Assert\Type(type="bool")
     * @var boolean $enableShrinkingForAlbumItemImage
     */
    protected $enableShrinkingForAlbumItemImage = false;
    
    /**
     * The maximum image width in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $shrinkWidthAlbumItemImage
     */
    protected $shrinkWidthAlbumItemImage = 800;
    
    /**
     * The maximum image height in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $shrinkHeightAlbumItemImage
     */
    protected $shrinkHeightAlbumItemImage = 600;
    
    /**
     * Thumbnail mode (inset or outbound).
     *
     * @Assert\NotBlank()
     * @EventPhotosAssert\ListEntry(entityName="appSettings", propertyName="thumbnailModeAlbumItemImage", multiple=false)
     * @var string $thumbnailModeAlbumItemImage
     */
    protected $thumbnailModeAlbumItemImage = 'inset';
    
    /**
     * Thumbnail width on view pages in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $thumbnailWidthAlbumItemImageView
     */
    protected $thumbnailWidthAlbumItemImageView = 32;
    
    /**
     * Thumbnail height on view pages in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $thumbnailHeightAlbumItemImageView
     */
    protected $thumbnailHeightAlbumItemImageView = 24;
    
    /**
     * Thumbnail width on display pages in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $thumbnailWidthAlbumItemImageDisplay
     */
    protected $thumbnailWidthAlbumItemImageDisplay = 240;
    
    /**
     * Thumbnail height on display pages in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $thumbnailHeightAlbumItemImageDisplay
     */
    protected $thumbnailHeightAlbumItemImageDisplay = 180;
    
    /**
     * Thumbnail width on edit pages in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $thumbnailWidthAlbumItemImageEdit
     */
    protected $thumbnailWidthAlbumItemImageEdit = 240;
    
    /**
     * Thumbnail height on edit pages in pixels.
     *
     * @Assert\Type(type="integer")
     * @Assert\NotBlank()
     * @Assert\NotEqualTo(value=0)
     * @Assert\LessThan(value=100000000000)
     * @var integer $thumbnailHeightAlbumItemImageEdit
     */
    protected $thumbnailHeightAlbumItemImageEdit = 180;
    
    /**
     * Which sections are supported in the Finder component (used by Scribite plug-ins).
     *
     * @Assert\NotNull()
     * @EventPhotosAssert\ListEntry(entityName="appSettings", propertyName="enabledFinderTypes", multiple=true)
     * @var string $enabledFinderTypes
     */
    protected $enabledFinderTypes = 'album###albumItem';
    
    
    /**
     * AppSettings constructor.
     *
     * @param VariableApiInterface $variableApi VariableApi service instance
     */
    public function __construct(
        VariableApiInterface $variableApi
    ) {
        $this->variableApi = $variableApi;
    
        $this->load();
    }
    
    /**
     * Returns the row height.
     *
     * @return integer
     */
    public function getRowHeight()
    {
        return $this->rowHeight;
    }
    
    /**
     * Sets the row height.
     *
     * @param integer $rowHeight
     *
     * @return void
     */
    public function setRowHeight($rowHeight)
    {
        if (intval($this->rowHeight) !== intval($rowHeight)) {
            $this->rowHeight = intval($rowHeight);
        }
    }
    
    /**
     * Returns the album entries per page.
     *
     * @return integer
     */
    public function getAlbumEntriesPerPage()
    {
        return $this->albumEntriesPerPage;
    }
    
    /**
     * Sets the album entries per page.
     *
     * @param integer $albumEntriesPerPage
     *
     * @return void
     */
    public function setAlbumEntriesPerPage($albumEntriesPerPage)
    {
        if (intval($this->albumEntriesPerPage) !== intval($albumEntriesPerPage)) {
            $this->albumEntriesPerPage = intval($albumEntriesPerPage);
        }
    }
    
    /**
     * Returns the link own albums on account page.
     *
     * @return boolean
     */
    public function getLinkOwnAlbumsOnAccountPage()
    {
        return $this->linkOwnAlbumsOnAccountPage;
    }
    
    /**
     * Sets the link own albums on account page.
     *
     * @param boolean $linkOwnAlbumsOnAccountPage
     *
     * @return void
     */
    public function setLinkOwnAlbumsOnAccountPage($linkOwnAlbumsOnAccountPage)
    {
        if (boolval($this->linkOwnAlbumsOnAccountPage) !== boolval($linkOwnAlbumsOnAccountPage)) {
            $this->linkOwnAlbumsOnAccountPage = boolval($linkOwnAlbumsOnAccountPage);
        }
    }
    
    /**
     * Returns the album item entries per page.
     *
     * @return integer
     */
    public function getAlbumItemEntriesPerPage()
    {
        return $this->albumItemEntriesPerPage;
    }
    
    /**
     * Sets the album item entries per page.
     *
     * @param integer $albumItemEntriesPerPage
     *
     * @return void
     */
    public function setAlbumItemEntriesPerPage($albumItemEntriesPerPage)
    {
        if (intval($this->albumItemEntriesPerPage) !== intval($albumItemEntriesPerPage)) {
            $this->albumItemEntriesPerPage = intval($albumItemEntriesPerPage);
        }
    }
    
    /**
     * Returns the link own album items on account page.
     *
     * @return boolean
     */
    public function getLinkOwnAlbumItemsOnAccountPage()
    {
        return $this->linkOwnAlbumItemsOnAccountPage;
    }
    
    /**
     * Sets the link own album items on account page.
     *
     * @param boolean $linkOwnAlbumItemsOnAccountPage
     *
     * @return void
     */
    public function setLinkOwnAlbumItemsOnAccountPage($linkOwnAlbumItemsOnAccountPage)
    {
        if (boolval($this->linkOwnAlbumItemsOnAccountPage) !== boolval($linkOwnAlbumItemsOnAccountPage)) {
            $this->linkOwnAlbumItemsOnAccountPage = boolval($linkOwnAlbumItemsOnAccountPage);
        }
    }
    
    /**
     * Returns the enable shrinking for album item image.
     *
     * @return boolean
     */
    public function getEnableShrinkingForAlbumItemImage()
    {
        return $this->enableShrinkingForAlbumItemImage;
    }
    
    /**
     * Sets the enable shrinking for album item image.
     *
     * @param boolean $enableShrinkingForAlbumItemImage
     *
     * @return void
     */
    public function setEnableShrinkingForAlbumItemImage($enableShrinkingForAlbumItemImage)
    {
        if (boolval($this->enableShrinkingForAlbumItemImage) !== boolval($enableShrinkingForAlbumItemImage)) {
            $this->enableShrinkingForAlbumItemImage = boolval($enableShrinkingForAlbumItemImage);
        }
    }
    
    /**
     * Returns the shrink width album item image.
     *
     * @return integer
     */
    public function getShrinkWidthAlbumItemImage()
    {
        return $this->shrinkWidthAlbumItemImage;
    }
    
    /**
     * Sets the shrink width album item image.
     *
     * @param integer $shrinkWidthAlbumItemImage
     *
     * @return void
     */
    public function setShrinkWidthAlbumItemImage($shrinkWidthAlbumItemImage)
    {
        if (intval($this->shrinkWidthAlbumItemImage) !== intval($shrinkWidthAlbumItemImage)) {
            $this->shrinkWidthAlbumItemImage = intval($shrinkWidthAlbumItemImage);
        }
    }
    
    /**
     * Returns the shrink height album item image.
     *
     * @return integer
     */
    public function getShrinkHeightAlbumItemImage()
    {
        return $this->shrinkHeightAlbumItemImage;
    }
    
    /**
     * Sets the shrink height album item image.
     *
     * @param integer $shrinkHeightAlbumItemImage
     *
     * @return void
     */
    public function setShrinkHeightAlbumItemImage($shrinkHeightAlbumItemImage)
    {
        if (intval($this->shrinkHeightAlbumItemImage) !== intval($shrinkHeightAlbumItemImage)) {
            $this->shrinkHeightAlbumItemImage = intval($shrinkHeightAlbumItemImage);
        }
    }
    
    /**
     * Returns the thumbnail mode album item image.
     *
     * @return string
     */
    public function getThumbnailModeAlbumItemImage()
    {
        return $this->thumbnailModeAlbumItemImage;
    }
    
    /**
     * Sets the thumbnail mode album item image.
     *
     * @param string $thumbnailModeAlbumItemImage
     *
     * @return void
     */
    public function setThumbnailModeAlbumItemImage($thumbnailModeAlbumItemImage)
    {
        if ($this->thumbnailModeAlbumItemImage !== $thumbnailModeAlbumItemImage) {
            $this->thumbnailModeAlbumItemImage = isset($thumbnailModeAlbumItemImage) ? $thumbnailModeAlbumItemImage : '';
        }
    }
    
    /**
     * Returns the thumbnail width album item image view.
     *
     * @return integer
     */
    public function getThumbnailWidthAlbumItemImageView()
    {
        return $this->thumbnailWidthAlbumItemImageView;
    }
    
    /**
     * Sets the thumbnail width album item image view.
     *
     * @param integer $thumbnailWidthAlbumItemImageView
     *
     * @return void
     */
    public function setThumbnailWidthAlbumItemImageView($thumbnailWidthAlbumItemImageView)
    {
        if (intval($this->thumbnailWidthAlbumItemImageView) !== intval($thumbnailWidthAlbumItemImageView)) {
            $this->thumbnailWidthAlbumItemImageView = intval($thumbnailWidthAlbumItemImageView);
        }
    }
    
    /**
     * Returns the thumbnail height album item image view.
     *
     * @return integer
     */
    public function getThumbnailHeightAlbumItemImageView()
    {
        return $this->thumbnailHeightAlbumItemImageView;
    }
    
    /**
     * Sets the thumbnail height album item image view.
     *
     * @param integer $thumbnailHeightAlbumItemImageView
     *
     * @return void
     */
    public function setThumbnailHeightAlbumItemImageView($thumbnailHeightAlbumItemImageView)
    {
        if (intval($this->thumbnailHeightAlbumItemImageView) !== intval($thumbnailHeightAlbumItemImageView)) {
            $this->thumbnailHeightAlbumItemImageView = intval($thumbnailHeightAlbumItemImageView);
        }
    }
    
    /**
     * Returns the thumbnail width album item image display.
     *
     * @return integer
     */
    public function getThumbnailWidthAlbumItemImageDisplay()
    {
        return $this->thumbnailWidthAlbumItemImageDisplay;
    }
    
    /**
     * Sets the thumbnail width album item image display.
     *
     * @param integer $thumbnailWidthAlbumItemImageDisplay
     *
     * @return void
     */
    public function setThumbnailWidthAlbumItemImageDisplay($thumbnailWidthAlbumItemImageDisplay)
    {
        if (intval($this->thumbnailWidthAlbumItemImageDisplay) !== intval($thumbnailWidthAlbumItemImageDisplay)) {
            $this->thumbnailWidthAlbumItemImageDisplay = intval($thumbnailWidthAlbumItemImageDisplay);
        }
    }
    
    /**
     * Returns the thumbnail height album item image display.
     *
     * @return integer
     */
    public function getThumbnailHeightAlbumItemImageDisplay()
    {
        return $this->thumbnailHeightAlbumItemImageDisplay;
    }
    
    /**
     * Sets the thumbnail height album item image display.
     *
     * @param integer $thumbnailHeightAlbumItemImageDisplay
     *
     * @return void
     */
    public function setThumbnailHeightAlbumItemImageDisplay($thumbnailHeightAlbumItemImageDisplay)
    {
        if (intval($this->thumbnailHeightAlbumItemImageDisplay) !== intval($thumbnailHeightAlbumItemImageDisplay)) {
            $this->thumbnailHeightAlbumItemImageDisplay = intval($thumbnailHeightAlbumItemImageDisplay);
        }
    }
    
    /**
     * Returns the thumbnail width album item image edit.
     *
     * @return integer
     */
    public function getThumbnailWidthAlbumItemImageEdit()
    {
        return $this->thumbnailWidthAlbumItemImageEdit;
    }
    
    /**
     * Sets the thumbnail width album item image edit.
     *
     * @param integer $thumbnailWidthAlbumItemImageEdit
     *
     * @return void
     */
    public function setThumbnailWidthAlbumItemImageEdit($thumbnailWidthAlbumItemImageEdit)
    {
        if (intval($this->thumbnailWidthAlbumItemImageEdit) !== intval($thumbnailWidthAlbumItemImageEdit)) {
            $this->thumbnailWidthAlbumItemImageEdit = intval($thumbnailWidthAlbumItemImageEdit);
        }
    }
    
    /**
     * Returns the thumbnail height album item image edit.
     *
     * @return integer
     */
    public function getThumbnailHeightAlbumItemImageEdit()
    {
        return $this->thumbnailHeightAlbumItemImageEdit;
    }
    
    /**
     * Sets the thumbnail height album item image edit.
     *
     * @param integer $thumbnailHeightAlbumItemImageEdit
     *
     * @return void
     */
    public function setThumbnailHeightAlbumItemImageEdit($thumbnailHeightAlbumItemImageEdit)
    {
        if (intval($this->thumbnailHeightAlbumItemImageEdit) !== intval($thumbnailHeightAlbumItemImageEdit)) {
            $this->thumbnailHeightAlbumItemImageEdit = intval($thumbnailHeightAlbumItemImageEdit);
        }
    }
    
    /**
     * Returns the enabled finder types.
     *
     * @return string
     */
    public function getEnabledFinderTypes()
    {
        return $this->enabledFinderTypes;
    }
    
    /**
     * Sets the enabled finder types.
     *
     * @param string $enabledFinderTypes
     *
     * @return void
     */
    public function setEnabledFinderTypes($enabledFinderTypes)
    {
        if ($this->enabledFinderTypes !== $enabledFinderTypes) {
            $this->enabledFinderTypes = isset($enabledFinderTypes) ? $enabledFinderTypes : '';
        }
    }
    
    
    /**
     * Loads module variables from the database.
     */
    protected function load()
    {
        $moduleVars = $this->variableApi->getAll('RKEventPhotosModule');
    
        if (isset($moduleVars['rowHeight'])) {
            $this->setRowHeight($moduleVars['rowHeight']);
        }
        if (isset($moduleVars['albumEntriesPerPage'])) {
            $this->setAlbumEntriesPerPage($moduleVars['albumEntriesPerPage']);
        }
        if (isset($moduleVars['linkOwnAlbumsOnAccountPage'])) {
            $this->setLinkOwnAlbumsOnAccountPage($moduleVars['linkOwnAlbumsOnAccountPage']);
        }
        if (isset($moduleVars['albumItemEntriesPerPage'])) {
            $this->setAlbumItemEntriesPerPage($moduleVars['albumItemEntriesPerPage']);
        }
        if (isset($moduleVars['linkOwnAlbumItemsOnAccountPage'])) {
            $this->setLinkOwnAlbumItemsOnAccountPage($moduleVars['linkOwnAlbumItemsOnAccountPage']);
        }
        if (isset($moduleVars['enableShrinkingForAlbumItemImage'])) {
            $this->setEnableShrinkingForAlbumItemImage($moduleVars['enableShrinkingForAlbumItemImage']);
        }
        if (isset($moduleVars['shrinkWidthAlbumItemImage'])) {
            $this->setShrinkWidthAlbumItemImage($moduleVars['shrinkWidthAlbumItemImage']);
        }
        if (isset($moduleVars['shrinkHeightAlbumItemImage'])) {
            $this->setShrinkHeightAlbumItemImage($moduleVars['shrinkHeightAlbumItemImage']);
        }
        if (isset($moduleVars['thumbnailModeAlbumItemImage'])) {
            $this->setThumbnailModeAlbumItemImage($moduleVars['thumbnailModeAlbumItemImage']);
        }
        if (isset($moduleVars['thumbnailWidthAlbumItemImageView'])) {
            $this->setThumbnailWidthAlbumItemImageView($moduleVars['thumbnailWidthAlbumItemImageView']);
        }
        if (isset($moduleVars['thumbnailHeightAlbumItemImageView'])) {
            $this->setThumbnailHeightAlbumItemImageView($moduleVars['thumbnailHeightAlbumItemImageView']);
        }
        if (isset($moduleVars['thumbnailWidthAlbumItemImageDisplay'])) {
            $this->setThumbnailWidthAlbumItemImageDisplay($moduleVars['thumbnailWidthAlbumItemImageDisplay']);
        }
        if (isset($moduleVars['thumbnailHeightAlbumItemImageDisplay'])) {
            $this->setThumbnailHeightAlbumItemImageDisplay($moduleVars['thumbnailHeightAlbumItemImageDisplay']);
        }
        if (isset($moduleVars['thumbnailWidthAlbumItemImageEdit'])) {
            $this->setThumbnailWidthAlbumItemImageEdit($moduleVars['thumbnailWidthAlbumItemImageEdit']);
        }
        if (isset($moduleVars['thumbnailHeightAlbumItemImageEdit'])) {
            $this->setThumbnailHeightAlbumItemImageEdit($moduleVars['thumbnailHeightAlbumItemImageEdit']);
        }
        if (isset($moduleVars['enabledFinderTypes'])) {
            $this->setEnabledFinderTypes($moduleVars['enabledFinderTypes']);
        }
    }
    
    /**
     * Saves module variables into the database.
     */
    public function save()
    {
        $this->variableApi->set('RKEventPhotosModule', 'rowHeight', $this->getRowHeight());
        $this->variableApi->set('RKEventPhotosModule', 'albumEntriesPerPage', $this->getAlbumEntriesPerPage());
        $this->variableApi->set('RKEventPhotosModule', 'linkOwnAlbumsOnAccountPage', $this->getLinkOwnAlbumsOnAccountPage());
        $this->variableApi->set('RKEventPhotosModule', 'albumItemEntriesPerPage', $this->getAlbumItemEntriesPerPage());
        $this->variableApi->set('RKEventPhotosModule', 'linkOwnAlbumItemsOnAccountPage', $this->getLinkOwnAlbumItemsOnAccountPage());
        $this->variableApi->set('RKEventPhotosModule', 'enableShrinkingForAlbumItemImage', $this->getEnableShrinkingForAlbumItemImage());
        $this->variableApi->set('RKEventPhotosModule', 'shrinkWidthAlbumItemImage', $this->getShrinkWidthAlbumItemImage());
        $this->variableApi->set('RKEventPhotosModule', 'shrinkHeightAlbumItemImage', $this->getShrinkHeightAlbumItemImage());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailModeAlbumItemImage', $this->getThumbnailModeAlbumItemImage());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailWidthAlbumItemImageView', $this->getThumbnailWidthAlbumItemImageView());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailHeightAlbumItemImageView', $this->getThumbnailHeightAlbumItemImageView());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailWidthAlbumItemImageDisplay', $this->getThumbnailWidthAlbumItemImageDisplay());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailHeightAlbumItemImageDisplay', $this->getThumbnailHeightAlbumItemImageDisplay());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailWidthAlbumItemImageEdit', $this->getThumbnailWidthAlbumItemImageEdit());
        $this->variableApi->set('RKEventPhotosModule', 'thumbnailHeightAlbumItemImageEdit', $this->getThumbnailHeightAlbumItemImageEdit());
        $this->variableApi->set('RKEventPhotosModule', 'enabledFinderTypes', $this->getEnabledFinderTypes());
    }
}
