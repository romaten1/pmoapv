<?php
include("./modules/phplot/phplot.php");
error_reporting(0);
$graph = new PHPlot;

$data=$_SESSION['data'];

if ($_SESSION['graph_style']=='bars'){
	$graph->SetDataType("text-data");
	$graph->SetXTickPos("none");
	if($_SESSION['approx_step']<=1) {
		$graph->SetXDataLabelAngle(90);
		$graph->x_label_inc=2;
		$graph->SetShading(1);
	} elseif($_SESSION['approx_step']>1 and $_SESSION['approx_step']<=2) {
		$graph->x_label_inc=2;
		$graph->SetShading(1);
	} else $graph->SetShading(3);
} else {
	$graph->SetDataType("data-data");
	$graph->SetHorizTickIncrement(5);
}
$graph->SetDataValues($data);
$graph->SetPlotType($_SESSION['graph_style']);
$graph->SetUseTTF(1);
$graph->SetTTFPath("modules/phplot");
$graph->SetDefaultTTFont("arial.ttf");
$graph->SetFont("x_label","arial.ttf",7);
$graph->SetFont("y_label","arial.ttf",7);
$graph->SetFont("legend","arial.ttf",7);
if(!$_SESSION['combined_mode']) {
	$graph->SetLegend(_CURRENT_SELECTION_GRAPH);
	if (@count($_SESSION['datas'])>=1) {
		$counter=1;
		foreach ($_SESSION['datas'] as $session_data)
			$graph->SetLegend(_GRAPH_NUMBER." ".$counter++);
	}
}	
$graph->SetXTitle(_COUNT_PERCENTS);
$graph->SetYTitle(_COUNT_USERS);
$graph->DrawGraph();