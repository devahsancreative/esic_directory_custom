<?php

class BaseConverter implements ConverterInterface
{
    /**
     * The options we use for html to markdown
     *
     * @var array
     */
    protected $options = array(
        'header_style' => 'atx',
        'bold_style' => '__',
        'italic_style' => '_',
    );

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
		 
       // return Markdown::defaultTransform($data['text']);
		//Arsalan edit 
		 //function start		
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
		$markDownVersion = Markdown::defaultTransform($data['text']);
		return $markDownVersion;
    }

    protected function htmlToMarkdown($html)
    {
        $markdown = new \HTML_To_Markdown($html, $this->options);
        return $markdown->output();
    }
}
