<script>
	let randomNumber = 0;
	let calculatedNumber = 0;

	$: calculatedNumber = randomNumber + calculatedNumber

	function handleClick() {
		randomNumber = Math.floor(Math.random() * (100 - 1 + 1)+1)
	}

</script>

<button on:click={handleClick}>
	generate random number
</button>
<p>The random number is {randomNumber}</p>
<p>The calculated number is {calculatedNumber}</p>

