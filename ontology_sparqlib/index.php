<?php
require_once( "sparqllib.php" );
 
$db = sparql_connect( "http://localhost:3030/model/sparql" );
if( !$db ) { echo sparql_errno() . ": " . sparql_error(). "\n"; exit; }
//sparql_ns( "data","http://www.risetgroup.org/ontologies/recommendersystem/smartphone#" );
 
$sparql = "PREFIX data: <http://www.risetgroup.org/ontologies/recommendersystem/smartphone#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX owl: <http://www.w3.org/2002/07/owl#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>

SELECT ?child WHERE { ?child rdfs:subClassOf data:Entertainment }";
$result = sparql_query( $sparql );
$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 
$fields = $result->field_array( $result );
 
while( $row = sparql_fetch_array( $result ) )
{
	print_r($row);
}
?>