@extends('layouts.app')

<h1>Specify widget pack sizes and Order Quantity:</h1>

<form action="/order" method="POST">
    <input type="number" name="order">

    <input type="number" id="packs" name="packs" value="">Number of packs:<br />
    <a href="#" id="filldetails" onclick="addFields()">add packs</a>
    <div id="container"/>

    </div>
    <button type="submit">submit</button>
    {{ csrf_field() }}
</form>

<script>
function addFields(){
            var number = document.getElementById("packs").value;
            var container = document.getElementById("container");
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=0;i<number;i++){
                container.appendChild(document.createTextNode("Pack " + (i+1)));
                var input = document.createElement("input");
                input.type = "number";
                input.name = i+1;
                container.appendChild(input);
                container.appendChild(document.createElement("br"));
            }
        }
</script>