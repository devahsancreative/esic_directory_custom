<?php

class ImageExtendedConverter implements ConverterInterface
{
    /**
     * The options we use for html to markdown
     *
     * @var array
     */

    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        return array(
            'type' => 'text',
            'data' => array( 
                'text' => ' ' . $this->htmlToMarkdown($html)
            )
        );
    }

    public function toHtml(array $data)
    {
		if (($data['source'] == "") || ($data['source'] == "http://")){
        return '<div class="custom_image"><img class="img-responsive" src="' . $data['file']['url'] . '" alt="' . $data['caption'] . '" /></div>' . "\n";
		} else {
        return '<div class="custom_image_a"><a href="' . $data['source'] . '" target="_blank"><img class="img-responsive" src="' . $data['file']['url'] . '" alt="' . $data['caption'] . '" /></a></div>' . "\n";
		}
    }
}
