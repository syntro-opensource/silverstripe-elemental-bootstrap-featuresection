<?php

namespace Syntro\SilverStripeElementalBootstrapFeatureSection\Elements;

use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use DNADesign\Elemental\Models\BaseElement;
use BucklesHusky\FontAwesomeIconPicker\Forms\FAPickerField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use Syntro\SilverStripeElementalBootstrapFeatureSection\Model\Feature;

/**
 *  Bootstrap based Feature section
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class FeatureSection extends BaseElement
{
    private static $icon = 'elemental-icon-features';
    /**
     * This defines the block name in the CSS
     *
     * @config
     * @var string
     */
    private static $block_name = 'feature-section';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    private static $styles = [
        'default' => 'Default with item on top',
        'small_left' => 'Small icon to the left'
    ];

    /**
     * @var string
     */
    // private static $icon = 'font-icon-attention';

    /**
     * @var string
     */
    private static $table_name = 'ElementFeatureSection';

    /**
     * set to false if image option should not show up
     *
     * @config
     * @var bool
     */
    private static $allow_image_background = true;

    /**
     * Available background colors for this Element
     *
     * @config
     * @var array
     */
    private static $background_colors = [];

    private static $text_colors = [];

    /**
     * Color mapping from background color. This is mainly intended
     * to set a default color on the section-level, ensuring text is readable.
     * Colors of subelementscan be added via templates
     *
     * @config
     * @var array
     */
    private static $text_colors_by_background = [];


    private static $db = [
        'Content' => 'Text',
    ];

    private static $has_many = [
        'Features' => Feature::class
    ];



    /**
     * fieldLabels - apply field labels
     *
     * @param  boolean $includerelations = true
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Title'] = _t(__CLASS__ . '.TITLE', 'Title');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Text');
        return $labels;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Content'));

            if ($this->ID) {
                /** @var GridField $features */
                $features = $fields->dataFieldByName('Features');
                $features->setTitle($this->fieldLabel('Features'));

                $fields->removeByName('Features');

                $config = $features->getConfig();
                $config->addComponent(new GridFieldOrderableRows('Sort'));
                $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
                $config->removeComponentsByType(GridFieldDeleteAction::class);

                $fields->addFieldToTab('Root.Main', $features);
            }
        });

        return parent::getCMSFields();
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return sprintf(
            '%s: "%s"',
            _t(
                __CLASS__ . '.SUMMARY',
                'one feature|{count} features',
                ['count' => $this->Features()->count()]
            ),
            implode('", "', $this->Features()->map('Title')->keys())
        );
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * getType
     *
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Feature Section');
    }
}
