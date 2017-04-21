<?php
class TweetConverter extends BaseConverter implements ConverterInterface{
    public function toJson(\DOMElement $node){
        $html = $node->ownerDocument->saveXML($node);

        return array(
            'type' => 'text',
            'data' => array(
                'text' => ' ' . $this->htmlToMarkdown($html)
            )
        );
    }
    public function toHtml(array $data){
		
        $id = $data['id'];
        $status_url = $data['status_url'];
        $text = $data['text'];
        $created_at = $data['created_at'];
        $status_url = $data['status_url'];
        //$html = json_encode($data);

	    if (!empty($status_url)) {
	        $html = "<blockquote class='twitter-widget twitter-tweet' align='center'>";
	        $html .= "<p>".$text."</p>";
	        $html .= "<a href='".$status_url."' data-datetime='".$created_at."'>".$created_at."</a>";
            $html .= "</blockquote>";
	        return $html;
	    }
	    return '';
    }
}
