<?php
namespace Syntro\SilverStripeElementalBootstrapFeatureSection\Model;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use Syntro\SilverStripeElementalBaseitems\Model\BaseItem;
use Syntro\SilverStripeElementalBootstrapFeatureSection\Elements\FeatureSection;
use Syntro\SilverStripeElementalBootstrapFeatureSection\Elements\IllustratedFeatureSection;

/**
 * Feature
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class Feature extends BaseItem
{
    /**
     * @var string
     */
    private static $table_name = 'ElementalBootstrapFeature';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'Content' => 'Text'
    ];

    private static $default_sort = ['Sort' => 'ASC'];

    /**
     * @var array
     */
    private static $has_one = [
        'Section' => FeatureSection::class,
        'IllustratedSection' => IllustratedFeatureSection::class,
        'Icon' => File::class,
        'CTALink' => Link::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Icon'
    ];

    private static $summary_fields = [
        'Icon.StripThumbnail',
        'Title',
        'Content.Summary'
    ];

    /**
     * fieldLabels - apply field labels
     *
     * @param  boolean $includerelations = true description
     * @return array                         description
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Icon.StripThumbnail'] = _t(__CLASS__ . '.ICON', 'Icon');
        $labels['Icon'] = _t(__CLASS__ . '.ICON', 'Icon');
        $labels['Title'] = _t(__CLASS__ . '.TITLE', 'Title');
        $labels['Content.Summary'] = _t(__CLASS__ . '.SUMMARY', 'Summary');
        $labels['CTALink'] = _t(__CLASS__ . '.CALLTOACTIONLINK', 'Call to action Link');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Text');
        return $labels;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            /** @var FieldList $fields */
            $fields->removeByName([
                'Sort',
                'SectionID',
                'IllustratedSectionID',
            ]);

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $iconField = UploadField::create(
                    'Icon',
                    $this->fieldLabel('Icon')
                )
            );
            $iconField->setAllowedExtensions([
                'svg',
                'png',
                'gif'
            ]);
            $iconField->setFolderName('Uploads/Features');
            $iconField->setDescription(_t(
                __CLASS__ . '.AllowedExtensions',
                'Allowed extensions: *.svg, *.png and *.gif. Use a square image and make sure the background is transparent.'
            ));

            // Add CTA Link
            $fields->removeByName('CTALinkID');
            $fields->addFieldsToTab(
                'Root.Main',
                [
                    LinkField::create(
                        'CTALink',
                        $this->fieldLabel('CTALink'),
                        $this
                    )
                ]
            );

            // Add content field
            $fields->addFieldToTab(
                'Root.Main',
                TextareaField::create(
                    'Content',
                    $this->fieldLabel('Content')
                ),
                'CTALink'
            );
        });

        return parent::getCMSFields();
    }

    /**
     * getIsSvgIcon - check wether the icon is an svg.
     *
     * @return bool
     */
    public function getIsSvgIcon()
    {
        return !($this->Icon instanceof Image);
    }
}
