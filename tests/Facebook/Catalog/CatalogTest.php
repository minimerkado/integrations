<?php

namespace Tests\Facebook\Catalog;

use Facebook\Catalog\Catalog;
use Facebook\Catalog\Item;
use Money\Currency;
use Money\Money;
use Orchestra\Testbench\TestCase;

class CatalogTest extends TestCase
{
    public function testAsXml()
    {
        $item1 = (new Item)
            ->setId('DB_1')
            ->setTitle('Blusa Nike')
            ->setDescription('Blusa Nike curta fresh tamanhos P, M, G')
            ->setBrand('Nike')
            ->setLink('https://test.vitrine.digital/products/DB_1')
            ->setImageLink('https://s3.vitrine.digital/images/products/DB_1')
            ->setPrice(new Money('20000', new Currency('USD')))
            ->setAdditionalImageLink([
                'https://s3.vitrine.digital/images/products/DB_1/1',
                'https://s3.vitrine.digital/images/products/DB_1/2'
            ])
            ->setAdditionalVariantAttribute('Cor', 'Azul');

        $item2 = (new Item)
            ->setId('DB_2')
            ->setTitle('Bone Nike')
            ->setDescription('Boné Nike Couro')
            ->setBrand('Nike')
            ->setLink('https://test.vitrine.digital/products/DB_2')
            ->setImageLink('https://s3.vitrine.digital/images/products/DB_2')
            ->setPrice(new Money('20000', new Currency('USD')));

        $catalog = (new Catalog)
            ->setLink('https://test.vitrine.digital/')
            ->setTitle('Loja Teste')
            ->setDescription('Descrição da Loja Teste')
            ->addItem($item1)
            ->addItem($item2);

        self::assertEquals(<<<XML
<?xml version="1.0"?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
  <channel>
    <title>Loja Teste</title>
    <link>https://test.vitrine.digital/</link>
    <description>Descri&#xE7;&#xE3;o da Loja Teste</description>
    <item>
      <g:id>DB_1</g:id>
      <g:title>Blusa Nike</g:title>
      <g:description>Blusa Nike curta fresh tamanhos P, M, G</g:description>
      <g:link>https://test.vitrine.digital/products/DB_1</g:link>
      <g:image_link>https://s3.vitrine.digital/images/products/DB_1</g:image_link>
      <g:brand>Nike</g:brand>
      <g:condition>new</g:condition>
      <g:price>200.00 USD</g:price>
      <g:status>active</g:status>
      <g:availability>in stock</g:availability>
      <g:additional_image_link>https://s3.vitrine.digital/images/products/DB_1/1,https://s3.vitrine.digital/images/products/DB_1/2</g:additional_image_link>
      <additional_variant_attribute>
        <label>Cor</label>
        <value>Azul</value>
      </additional_variant_attribute>
    </item>
    <item>
      <g:id>DB_2</g:id>
      <g:title>Bone Nike</g:title>
      <g:description>Bon&#xE9; Nike Couro</g:description>
      <g:link>https://test.vitrine.digital/products/DB_2</g:link>
      <g:image_link>https://s3.vitrine.digital/images/products/DB_2</g:image_link>
      <g:brand>Nike</g:brand>
      <g:condition>new</g:condition>
      <g:price>200.00 USD</g:price>
      <g:status>active</g:status>
      <g:availability>in stock</g:availability>
    </item>
  </channel>
</rss>

XML, $catalog->asXml());
    }
}