{* Purpose of this template: edit view of specific item detail view content type *}

<div style="margin-left: 80px">
    <div class="form-group">
        {formlabel for='rKEventPhotosModuleObjectType' __text='Object type' cssClass='col-sm-3 control-label'}
        <div class="col-sm-9">
            {rkeventphotosmoduleObjectTypeSelector assign='allObjectTypes'}
            {formdropdownlist id='rKEventPhotosModuleObjectType' dataField='objectType' group='data' mandatory=true items=$allObjectTypes cssClass='form-control'}
            <span class="help-block">{gt text='If you change this please save the element once to reload the parameters below.'}</span>
        </div>
    </div>
    <div{* class="form-group"*}>
        <p>{gt text='Please select your item here. You can resort the dropdown list and reduce it\'s entries by applying filters. On the right side you will see a preview of the selected entry.' domain='rkeventphotosmodule'}</p>
        {rkeventphotosmoduleItemSelector id='id' group='data' objectType=$objectType}
    </div>

    <div{* class="form-group"*}>
        {gt text='Link to object' assign='displayModeLabel'}
        {formradiobutton id='linkButton' value='link' dataField='displayMode' group='data' mandatory=1}
        {formlabel for='linkButton' text=$displayModeLabel}
        {gt text='Embed object display' assign='displayModeLabel'}
        {formradiobutton id='embedButton' value='embed' dataField='displayMode' group='data' mandatory=1}
        {formlabel for='embedButton' text=$displayModeLabel}
    </div>

    <div{* class="form-group"*}>
        {gt text='Custom template' domain='rkeventphotosmodule' assign='customTemplateLabel'}
        {formlabel for='rKEventPhotosModuleCustomTemplate' text=$customTemplateLabel cssClass='col-sm-3 control-label'}
        <div class="col-sm-9">
            {formtextinput id='rKEventPhotosModuleCustomTemplate' dataField='customTemplate' group='data' mandatory=false maxLength=80 cssClass='form-control'}
            <span class="help-block">{gt text='Example' domain='rkeventphotosmodule'}: <em>displaySpecial.html.twig</em></span>
            <span class="help-block">{gt text='Needs to be located in the "External/YourEntity/" directory.' domain='rkeventphotosmodule'}</span>
        </div>
    </div>
</div>
