---
layout: page
title: AI-ify
permalink: /projects/aiify/
class: project_page
---

<head>
	<style>
		.textbox {
			background-color: powderblue;
			width=100%;
			line-height: 4em; 
			font-size: 1em;
			font-family: sans-serif;
			text-align: center;
			margin: 1em;
		}
	</style>
</head>

You see AI all around you, and you want your company to use it. You've hired full-stack engineers and GenAI specialists to 10x the value of your product line and reduce costs.

But you're doing it wrong.

You can't just *add* AI to your product line. You need to rethink your product from scratch, leveraging AI. AI needs to be *embedded* into your product.

If your product has AI in its DNA, then it also needs a new *name*.

To dos:

- Style the site to be trendy
- Add silly trendy fonts
- Add a "add more AI" button, or an "intensity" slider to allow outputs ranging from "intensAIty" to "AIntensAItAI.AI.AI"
- Make the preamble funnier
- Better URL? jbls.fun/moreAI

<div onload="updateValue()">
	Enter your company name here:
	<input class="textbox" id="company_input" style="background-color:lightgrey;" value="Company Name">
</div>
<div style="width: 100%">
	<button class="textbox" onclick="updateValue()"> → MAKE IT AI →</button>
</div>
<div class="textbox" id="output_container" style=" background-color:pink;">
	<span id="output">
	</span>
</div>
<script>
// select element input
const input = document.querySelector('input');

// event listener invoke when something change in input
// input.addEventListener('input', updateValue);

// method 
function updateValue(e) {
	document.getElementById("output").innerHTML = aiify_companyname(document.getElementsByTagName('input')[0].value);
}


function aiify_companyname(companyName) {
	lowercase_company = companyName.toLowerCase()
	if (lowercase_company.includes("y")) {
		ai_index = lowercase_company.lastIndexOf("y")
		firstHalf = companyName.slice(0, ai_index)
		secondHalf = companyName.slice(ai_index+1)
	} else if (lowercase_company.includes("ai")) {
		ai_index = lowercase_company.lastIndexOf("ai")
		firstHalf = companyName.slice(0, ai_index)
		secondHalf = companyName.slice(ai_index+2)
	} else if (lowercase_company.includes("al")) {
		ai_index = lowercase_company.lastIndexOf("al")
		firstHalf = companyName.slice(0, ai_index)
		secondHalf = companyName.slice(ai_index+2)
	} else if (lowercase_company.includes("a")) {
		ai_index = lowercase_company.lastIndexOf("a")
		firstHalf = companyName.slice(0, ai_index)
		secondHalf = companyName.slice(ai_index+1)
	} else if (lowercase_company.includes("i")) {
		ai_index = lowercase_company.lastIndexOf("i")
		firstHalf = companyName.slice(0, ai_index)
		secondHalf = companyName.slice(ai_index+1)
	} else {
		firstHalf = companyName.concat(".")
		secondHalf = ""
	}
	newCompanyName = "".concat(firstHalf, "<strong><u>AI</u></strong>", secondHalf)
	if (newCompanyName === ".<strong>AI</strong>") {
		newCompanyName = "";
	}
	return newCompanyName;
}

// updateValue()
</script>