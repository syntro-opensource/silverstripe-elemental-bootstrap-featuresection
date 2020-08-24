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
            ]);

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $iconField = UploadField::create(
                    'Icon',
                    'Icon'
                )
            );
            $iconField->setAllowedExtensions([
                'svg',
                'png',
                'gif'
            ]);
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
                        'Call to action',
                        $this
                    )
                ]
            );

            // Add content field
            $fields->addFieldToTab(
                'Root.Main',
                TextareaField::create(
                    'Content',
                    'Content'
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
