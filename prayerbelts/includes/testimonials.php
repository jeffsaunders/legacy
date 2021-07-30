<!-- BEGIN Include testimonials.php -->

<div id="testimonialsPage">
	<div id="testimonialsPageHeadline">Testimonials</div>
	<div id="testimonialsPageText">
		<table>
		<?
		$xml = simplexml_load_file('xml/testimonials.xml');
		$json = json_encode($xml);
		$testimonials = json_decode($json, TRUE);
		//print_r($testimonials);
		for ($cnt=0; $cnt < sizeof($testimonials['testimonial']); $cnt++){
		?>
		<tr>
			<td><hr width="100%" size="2" color="#F0F0F0"></td>
		</tr>
		<tr>
			<td>"<?=$testimonials['testimonial'][$cnt]['text'];?>"</td>
		</tr>
		<tr>
			<td class="testimonialPageLabel"><?=$testimonials['testimonial'][$cnt]['author'];?> &mdash; <?=$testimonials['testimonial'][$cnt]['city'];?>, <?=$testimonials['testimonial'][$cnt]['state'];?></td>
		</tr>
		<?
		}
		?>
		</table>
		<br>
		<div id="testimonialsPageImage"></div>
	</div>
</div>

<!-- END Include testimonials.php -->
