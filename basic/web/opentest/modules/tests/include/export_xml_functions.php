<?php
if (INDEXPHP!=1)
         die ("You can't access this file directly...");


         
         
         
         
function export_test($test_id,$donot_export_disabled)
  {
  global $domxml;
  $xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><opentest_xml type=\"tests_xml\" format_version=\"2.0\" ></opentest_xml>";

  $domxml=domxml_open_mem($xml);
  $domxml->charset="utf-8";
  $root_node=$domxml->document_element ();
  $res_test=sql_query("select * from tests where test_id='$test_id' ");
  while ($f_test=mysql_fetch_array($res_test))
         {
         $test_node1=$domxml->create_element("test");
	 $root_node=$root_node->append_child($test_node1);


         $root_node->set_attribute("disabled", $f_test['test_disable']);
         $test_name_node=$domxml->create_element("test_name");
         $test_name_text=$domxml->create_text_node($f_test['test_name']);
         $test_name_node->append_child($test_name_text);
         $root_node->append_child($test_name_node);

         $test_description_node=$domxml->create_element("test_description");
         @$test_description_text=$domxml->create_text_node($f_test['test_description']);
         $test_description_node->append_child($test_description_text);
         $root_node->append_child($test_description_node);

         $date=date("Y-m-d H:i:s");
         $date_created_node=$domxml->create_element("date_created");
         $date_created_text=$domxml->create_text_node($date);
         $date_created_node->append_child($date_created_text);
         $root_node->append_child($date_created_node);

         $generator_node=$domxml->create_element("generator");
         $generator_text=$domxml->create_text_node("OpenTEST TestStudio 1.0");
         $generator_node->append_child($generator_text);
         $root_node->append_child($generator_node);

		 $sql_add="";
         $content_node=$domxml->create_element("content");
         if ($donot_export_disabled)
         		{$sql_add=" and topic_disable=0 ";}
         $res_topics=sql_query("select * from topics where test_id='".$f_test['test_id']."' $sql_add ");
         while ($f_topic=mysql_fetch_array($res_topics))
            {
            	
            append_topic($content_node,$f_topic,$donot_export_disabled);
            }

         $root_node->append_child($content_node);

         }
  $return=$domxml->dump_mem(true,"utf-8");
  return($return);
  }

//-------------------------------------------------------------------------

function append_topic($content_node,$f_topic,$donot_export_disabled)
     {
     global $domxml;
     $topic_node=$domxml->create_element("topic");
     $content_node->append_child($topic_node);
     $topic_node->set_attribute("disabled", $f_topic['topic_disable']);
     $topic_name_node=$domxml->create_element("topic_name");
     $topic_name_text=$domxml->create_text_node($f_topic['topic_name']);
     $topic_name_node->append_child($topic_name_text);
     $topic_node->append_child($topic_name_node);

     $content_node=$domxml->create_element("content");
     $sql_add="";
     if ($donot_export_disabled)
         		{$sql_add=" and question_disable=0 ";}
     $res_questions=sql_query("select * from questions where topic_id='$f_topic[topic_id]' $sql_add ");
     while ($f_question=mysql_fetch_array($res_questions))
        {
        append_question($content_node,$f_question,$donot_export_disabled);
        }

     $topic_node->append_child($content_node);

     }

//-------------------------------------------------------------------------

function append_question($content_node,$f_question,$donot_export_disabled)
     {
     global $domxml;
     $question_node=$domxml->create_element("question");
     $content_node->append_child($question_node);
     $question_node->set_attribute("question_type", $f_question['question_type']);
     $question_node->set_attribute("answers_delay", $f_question['show_later']);
     $question_node->set_attribute("question_difficulty", $f_question['question_difficulty']);
     $question_node->set_attribute("disabled", $f_question['question_disable']);
     $question_name_node=$domxml->create_element("question_text");
     $question_text=process_htmltext($f_question['question_text']);
     $question_name_text=$domxml->create_text_node($question_text);
     $question_name_node->append_child($question_name_text);

     $question_node->append_child($question_name_node);

     $content_node=$domxml->create_element("content");


     $res_answers=sql_query("select * from answers where question_id='".$f_question['question_id']."'  ");
     while ($f_answer=mysql_fetch_array($res_answers))
        {

        append_answer($content_node,$f_answer,$donot_export_disabled,$f_question['question_type']);
        }

     $question_node->append_child($content_node);

     }

//-------------------------------------------------------------------------

function append_answer($content_node,$f_answer,$donot_export_disabled,$question_type)
     {
     global $domxml;
     $answer_node=$domxml->create_element("answer");
     $content_node->append_child($answer_node);
     $answer_node->set_attribute("true", $f_answer['answer_true']);
     $answer_node->set_attribute("true_percent", $f_answer['true_percent']);
     $answer_node->set_attribute("sample", urlencode($f_answer['answer_sample']));     
     if ($question_type=='3') $answer_node->set_attribute("sample_id", urlencode($f_answer['answer_id']));
     $answer_node->set_attribute("use_regexp", $f_answer['use_regexp']);     
     $serialized_regexp_node=$domxml->create_element("serialized_regexp");
     $serialized_regexp_text=$domxml->create_text_node($f_answer['serialized_regexp']);
     $serialized_regexp_node->append_child($serialized_regexp_text);
     $answer_node->append_child($serialized_regexp_node);
     $answer_name_node=$domxml->create_element("answer_text");
     $answer_text=process_htmltext($f_answer['answer_text']);
     $answer_name_text=$domxml->create_text_node($answer_text);
     $answer_name_node->append_child($answer_name_text);
     $answer_node->append_child($answer_name_node);
	
     
     
     
     //$answer_node->append_child($content_node);

     }


/// --------------------------
function process_htmltext($html_text)
     {
     $html_text_return=htmlspecialchars($html_text);
     $html_text_return=replace_objects($html_text_return);


     return $html_text_return;
     }


function replace_objects($string) {
    $string=preg_replace_callback("/&lt;\s*((embed)|(img)).*&gt;/Ui",'callback_flush_image',$string);
    return $string;
}

function callback_flush_image($data)
    {
    global $domxml;
    $data_tag=validate_tag($data[0]);

	$xslt_str = join("",file("./modules/".$GLOBALS['module']."/include/xmls/html_to_xml.xslt"));
    $xmldoc = domxml_open_mem($data_tag);
    $root_node=$xmldoc->document_element();
    $attr_type=$root_node->get_attribute("type");
    switch($attr_type)
           {
           case $GLOBALS['config']['flash_type']:
                 {
                 $root_node->set_attribute("opentest_type","flash");
                 break;
                 }
           case $GLOBALS['config']['video_type']:
                 {
                 $root_node->set_attribute("opentest_type","video");
                 break;
                 }
           case "application/x-shockwave-flash":
                 {
                 $root_node->set_attribute("opentest_type","image");
                 break;
                 }
           default:
                   {
                   $root_node->set_attribute("opentest_type","image");
                   }
           }

   $xsldoc = domxml_xslt_stylesheet($xslt_str);
   
    $result =  $xsldoc->process($xmldoc);
    $res=$xsldoc->result_dump_mem($result);
    echo "<textarea>$res</textarea>";
    
    $res=str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>","",$res);

	
    return $res;

    }




function validate_tag($data)
     {
     global $config;
$data_html=html_entity_decode($data);
require_once('XML/HTMLSax3.php');
$handler= new HTMLtoXHTMLHandler();
$parser= new XML_HTMLSax3();
$parser->set_object($handler);
$parser->set_element_handler('openHandler','closeHandler');
$parser->set_data_handler('dataHandler');
$parser->set_escape_handler('escapeHandler');
$parser->parse($data_html);
$data2_xhtml=$handler->getXHTML();
     return $data2_xhtml;
     }
     
     
class HTMLtoXHTMLHandler {
    var $xhtml;
    var $inTitle;
    var $pCounter;

    function HTMLtoXHTMLHandler(){
        $this->xhtml='';
        $this->inTitle = false;
        $this->pCounter=0;
    }

    // Handles the writing of attributes - called from $this->openHandler()
    function writeAttrs ($attrs) {
        if ( is_array($attrs) ) {
            foreach ( $attrs as $name => $value ) {
   
     $value=preg_replace("/".str_replace("/",'\/',$GLOBALS['config']['opentest_root_url'])."\/media\/test_([0-9]*)\//Ui","",$value);   
     $value=preg_replace("/".str_replace("/",'\/',$GLOBALS['config']['additional_path'])."\/media\/test_([0-9]*)\//Ui","",$value);
                 	
                // Watch for 'checked'
                if ( $name == 'checked' ) {
                    $this->xhtml.=' checked="checked"';
                // Watch for 'selected'
                } else if ( $name == 'selected' ) {
                    $this->xhtml.=' selected="selected"';
                } else {
                    $this->xhtml.=' '.$name.'="'.$value.'"';
                }
            }
        }
    }

    // Opening tag handler
    function openHandler(& $parser,$name,$attrs) {
        if ( (isset ( $attrs['id'] ) && $attrs['id'] == 'title') || $name == 'title' )
            $this->inTitle=true;
	$name=strtolower($name);
        switch ($name ) {
            case 'br':
                $this->xhtml.="<br />\n";
                break;
            case 'img':
                $this->xhtml.="<".$name;
                $this->writeAttrs($attrs);
                $this->xhtml.=" />\n";
                break;            	
            
            case 'embed':
                $this->xhtml.="<".$name;
                $this->writeAttrs($attrs);
                $this->xhtml.=" />\n";
                break;            	
            case 'html':
                $this->xhtml.="<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"eng\">\n";
                break;
            case 'p':
                if ( $this->pCounter != 0 ) {
                    $this->xhtml.="</p>\n";
                }
                $this->xhtml.="<p>";
                $this->pCounter++;
                break;
            default:
                $this->xhtml.="<".$name;
                $this->writeAttrs($attrs);
                $this->xhtml.=">\n";
                break;
        }

    }

    // Closing tag handler
    function closeHandler(& $parser,$name) {
        if ( $this->inTitle ) {
            $this->inTitle=false;
        }
        $name=strtolower($name);
        if ($name == 'body' && $this->pCounter != 0)
            $this->xhtml.="</p>\n";
        if ($name != 'img' && $name != 'embed')
        {            
        $this->xhtml.="</".$name.">\n";
        }
    }

    // Character data handler
    function dataHandler(& $parser,$data) {
        if ( $this->inTitle )
            $this->xhtml.='This is XHTML 1.0';
        else
            $this->xhtml.=$data;
    }

    // Escape handler
    function escapeHandler(& $parser,$data) {
        if ( $data == 'doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN"' )
            $this->xhtml.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    }

    // Return the XHTML document
    function getXHTML () {
        return $this->xhtml;
    }
}