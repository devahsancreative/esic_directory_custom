<?php

class HeadingConverter extends BaseConverter implements ConverterInterface
{
    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        // remove the h2 tags from the text. We just need the inner text.
        $html = preg_replace('/<(\/|)h2>/i', '', $html);

        return array(
            'type' => 'heading',
            'data' => array(
                'text' => ' ' . $this->htmlToMarkdown($html)
            )
        );
    }

    public function toHtml(array $data)
    {
		//return Markdown::defaultTransform('## ' . $data['text']);
		//Arsalan edit 
	 	foreach ($data as $n => &$v)
		{  
			if( $n == 'text'){
					$data_key_only = array_keys($data);
					for($k=(count($data_key_only)-1); $k>-1; $k-- ){
						if (substr($data_key_only[$k], 0, 4) == 'mce_' && $data[$data_key_only[$k]] != ''){
							 $data['text'] = $data[$data_key_only[$k]];
							  break;  
						}
					}
				}          
			} 
		//function end here		 
		return Markdown::defaultTransform('## ' . $data['text']);
    }
}
