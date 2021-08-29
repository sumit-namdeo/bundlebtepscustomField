<?php

namespace Sn\BundleStepsCustomField\Plugin\Catalog\Ui\DataProvider\Product\Form\Modifier;

class BundlePanel {

    public function afterModifyMeta(
        \Magento\Bundle\Ui\DataProvider\Product\Form\Modifier\BundlePanel $subject,
        $meta
    ){

        $fieldSet = [
            'option_info' => [
                'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                'formElement'   => \Magento\Ui\Component\Form\Element\Input::NAME,
                'label' => 'Option Message',
                'dataScope' => 'option_info',
                'sortOrder' => 11
            ]
        ];

        foreach ($fieldSet as $filed => $fieldOptions)
        {
            $meta['bundle-items']['children']['bundle_options']['children']
            ['record']['children']['product_bundle_container']['children']['option_info']['children'][$filed] = $this->getSelectionCustomText($fieldOptions);
        }

        return $meta;

    }


    protected function getSelectionCustomText($fieldOptions)
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => \Magento\Ui\Component\Form\Field::NAME,
                        'dataType'      => $fieldOptions['dataType'],
                        'formElement'   => $fieldOptions['formElement'],
                        'label'         => __($fieldOptions['label']),
                        'dataScope'     => $fieldOptions['dataScope'],
                        'sortOrder'     => $fieldOptions['sortOrder'],
                        'options'       => array_key_exists('options', $fieldOptions) ? $fieldOptions['options']: "",
                    ]
                ]
            ]
        ];
    }

    protected function getSkuFieldConfig($sortOrder, array $options = []){

        return array_replace_recursive(
            [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label' => __('Option Message'),
                            'componentType' => \Magento\Ui\Component\Form\Field::NAME,
                            'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                            'dataScope' => 'option_info',
                            'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                            'sortOrder' => $sortOrder,
                            'validation' => [
                                'required-entry' => true,
                                'validate-alphanum-with-spaces' => true
                            ]
                        ]
                    ]
                ]
            ],
            $options
        );
    }
}
