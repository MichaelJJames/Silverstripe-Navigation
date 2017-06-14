<?php
class SiteConfigNavExtension extends DataExtension 
{

    private static $many_many = array(
        'Navigation' => 'Page'
    );
  
    public static $many_many_extraFields = array(
        'Navigation' => array(
            'SortOrder' => 'Int'
        )
    );

    public function Navigation() {
        $owner = $this->owner;
        return $owner->getManyManyComponents('Navigation')->sort('SortOrder');
    }

    public function updateCMSFields(FieldList $fields) {

        $owner = $this->owner;
        $gridfieldconfig = gridfieldconfig_relationeditor::create();
        $gridfieldconfig->removecomponentsbytype('gridfieldaddnewbutton');
        $gridfieldconfig->removecomponentsbytype('gridfieldeditbutton');
        $gridfieldconfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $gridfield = GridField::create("Navigation", "Navigation", $owner->Navigation()->sort("SortOrder"), $gridfieldconfig);
        $fields->addFieldToTab('Root.Navigation', $gridfield);

    }

}