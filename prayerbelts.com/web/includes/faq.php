<!-- BEGIN Include faq.php -->

<div id="frequentlyAskedQuestions">
	<div id="faqHeadline">Frequently Asked Questions</div>
	<div id="faqText">
		<table>
		<?
		$xml = simplexml_load_file('xml/faq.xml');
		$json = json_encode($xml);
		$faqs = json_decode($json, TRUE);
		//print_r($faqs);
		for ($cnt=0; $cnt < sizeof($faqs['faq']); $cnt++){
		?>
		<tr>
			<td valign="top">Q:</td>
			<td><strong><?=stripslashes(str_replace('{', '<', str_replace('}', '>', $faqs['faq'][$cnt]['question'])));?></strong></td>
		</tr>
		<tr>
			<td valign="top">A:</td>
			<td><?=stripslashes(str_replace('{', '<', str_replace('}', '>', $faqs['faq'][$cnt]['answer'])));?></td>
		</tr>
		<?
			if (strpos($faqs['faq'][$cnt]['answer'], "{ul}") == 0){
		?>
		<tr>
			<td height="10" colspan="2"></td>
		</tr>
		<?
			}
		}
		?>
		</table>
		<br>
		<div id="faqImage"></div>
	</div>
</div>

<!-- END Include faq.php -->
