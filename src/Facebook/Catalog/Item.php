<?php

namespace Facebook\Catalog;

use Carbon\Carbon;
use Common\Utilities;
use Common\XmlEncodable;
use Illuminate\Support\Arr;
use Money\Money;

class Item implements XmlEncodable
{
    use Utilities;

    private string $id;
    private string $title;
    private string $description;
    private string $link;
    private string $image_link;
    private string $brand;
    private string $condition;
    private Money $price;
    private string $status;
    private string $availability;

    /** @var string[] */
    private array $additional_image_link = [];

    private ?int $quantity_to_sell_on_facebook = null;
    private ?string $fb_product_category = null;
    private ?string $google_product_category = null;

    private ?Money $sale_price = null;
    private ?SalePriceEffectiveDate $sale_price_effective_date = null;
    private ?string $item_group_id = null;

    private ?string $color = null;
    private ?string $gender = null;
    private ?string $size = null;
    private ?string $age_group = null;
    private ?string $material = null;
    private ?string $pattern = null;
    private ?Shipping $shipping = null;

    private ?string $custom_label_0 = null;
    private ?string $custom_label_1 = null;
    private ?string $custom_label_2 = null;
    private ?string $custom_label_3 = null;
    private ?string $custom_label_4 = null;

    public function __construct()
    {
        $this->condition = Condition::NEW;
        $this->status = Status::ACTIVE;
        $this->availability = Availability::IN_STOCK;
    }

    public function encode(\SimpleXMLElement $root)
    {
        $item = $root->addChild('item');

        self::addChild($item, 'id', $this->id);
        self::addChild($item, 'title', $this->title);
        self::addChild($item, 'description', $this->description);
        self::addChild($item, 'link', $this->link);
        self::addChild($item, 'image_link', $this->image_link);
        self::addChild($item, 'brand', $this->brand);
        self::addChild($item, 'condition', $this->condition);
        self::addChild($item, 'price', self::formatByDecimal($this->price, show_currency: true));
        self::addChild($item, 'status', $this->status);
        self::addChild($item, 'availability', $this->availability);
        self::addChild($item, 'additional_image_link', collect($this->additional_image_link)->join(','));

        self::addChild($item, 'quantity_to_sell_on_facebook', $this->quantity_to_sell_on_facebook);
        self::addChild($item, 'fb_product_category', $this->fb_product_category);
        self::addChild($item, 'google_product_category', $this->google_product_category);
        self::when($this->sale_price,
            fn () => $root->addChild('sale_price', self::formatByDecimal($this->sale_price, show_currency: true), Catalog::GOOGLE_NS)
        );
        $this->sale_price_effective_date?->encode($item);

        self::addChild($item, 'item_group_id', $this->item_group_id);
        self::addChild($item, 'color', $this->color);
        self::addChild($item, 'gender', $this->gender);
        self::addChild($item, 'size', $this->size);
        self::addChild($item, 'age_group', $this->age_group);
        self::addChild($item, 'material', $this->material);
        self::addChild($item, 'pattern', $this->pattern);
        $this->shipping?->encode($item);

        self::addChild($item, 'custom_label_0', $this->custom_label_0);
        self::addChild($item, 'custom_label_1', $this->custom_label_1);
        self::addChild($item, 'custom_label_2', $this->custom_label_2);
        self::addChild($item, 'custom_label_3', $this->custom_label_3);
        self::addChild($item, 'custom_label_4', $this->custom_label_4);
    }

    private static function addChild(\SimpleXMLElement $root, string $name, mixed $value) {
        self::when($value, fn () => $root->addChild($name, $value, Catalog::GOOGLE_NS));
    }

    /**
     * @param string $id
     * @return Item
     */
    public function setId(string $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     * @return Item
     */
    public function setTitle(string $title): Item
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $link
     * @return Item
     */
    public function setLink(string $link): Item
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @param string $image_link
     * @return Item
     */
    public function setImageLink(string $image_link): Item
    {
        $this->image_link = $image_link;
        return $this;
    }

    /**
     * @param string $brand
     * @return Item
     */
    public function setBrand(string $brand): Item
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @param string $condition
     * @return Item
     */
    public function setCondition(string $condition): Item
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @param Money $price
     * @return Item
     */
    public function setPrice(Money $price): Item
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param string $status
     * @return Item
     */
    public function setStatus(string $status): Item
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $availability
     * @return Item
     */
    public function setAvailability(string $availability): Item
    {
        $this->availability = $availability;
        return $this;
    }

    /**
     * @param string[] $additional_image_link
     * @return Item
     */
    public function setAdditionalImageLink(array $additional_image_link): Item
    {
        $this->additional_image_link = $additional_image_link;
        return $this;
    }

    /**
     * @param int|null $quantity_to_sell_on_facebook
     * @return Item
     */
    public function setQuantityToSellOnFacebook(?int $quantity_to_sell_on_facebook): Item
    {
        $this->quantity_to_sell_on_facebook = $quantity_to_sell_on_facebook;
        return $this;
    }

    /**
     * @param string|null $fb_product_category
     * @return Item
     */
    public function setFbProductCategory(?string $fb_product_category): Item
    {
        $this->fb_product_category = $fb_product_category;
        return $this;
    }

    /**
     * @param string|null $google_product_category
     * @return Item
     */
    public function setGoogleProductCategory(?string $google_product_category): Item
    {
        $this->google_product_category = $google_product_category;
        return $this;
    }

    /**
     * @param Money|null $sale_price
     * @return Item
     */
    public function setSalePrice(?Money $sale_price): Item
    {
        $this->sale_price = $sale_price;
        return $this;
    }

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @return $this
     */
    public function setSalePriceEffectiveDate(Carbon $start, Carbon $end): Item
    {
        $this->sale_price_effective_date = new SalePriceEffectiveDate($start, $end);
        return $this;
    }

    /**
     * @param string|null $item_group_id
     * @return Item
     */
    public function setItemGroupId(?string $item_group_id): Item
    {
        $this->item_group_id = $item_group_id;
        return $this;
    }

    /**
     * @param string|null $color
     * @return Item
     */
    public function setColor(?string $color): Item
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @param string|null $gender
     * @return Item
     */
    public function setGender(?string $gender): Item
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param string|null $size
     * @return Item
     */
    public function setSize(?string $size): Item
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @param string|null $age_group
     * @return Item
     */
    public function setAgeGroup(?string $age_group): Item
    {
        $this->age_group = $age_group;
        return $this;
    }

    /**
     * @param string|null $material
     * @return Item
     */
    public function setMaterial(?string $material): Item
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @param string|null $pattern
     * @return Item
     */
    public function setPattern(?string $pattern): Item
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @param Shipping|null $shipping
     * @return Item
     */
    public function setShipping(?Shipping $shipping): Item
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @param string|null $custom_label_0
     * @return Item
     */
    public function setCustomLabel0(?string $custom_label_0): Item
    {
        $this->custom_label_0 = $custom_label_0;
        return $this;
    }

    /**
     * @param string|null $custom_label_1
     * @return Item
     */
    public function setCustomLabel1(?string $custom_label_1): Item
    {
        $this->custom_label_1 = $custom_label_1;
        return $this;
    }

    /**
     * @param string|null $custom_label_2
     * @return Item
     */
    public function setCustomLabel2(?string $custom_label_2): Item
    {
        $this->custom_label_2 = $custom_label_2;
        return $this;
    }

    /**
     * @param string|null $custom_label_3
     * @return Item
     */
    public function setCustomLabel3(?string $custom_label_3): Item
    {
        $this->custom_label_3 = $custom_label_3;
        return $this;
    }

    /**
     * @param string|null $custom_label_4
     * @return Item
     */
    public function setCustomLabel4(?string $custom_label_4): Item
    {
        $this->custom_label_4 = $custom_label_4;
        return $this;
    }
}