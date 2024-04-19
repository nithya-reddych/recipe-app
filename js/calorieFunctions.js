// Takes array of food names and optionally, array of weight strings
// Returns associative array where key is food name
// and value is calorie count.
//
// Example: calories(["chicken", "pork"], ["20 oz", "2 lbs"])
async function calories(ingredients, weights = []) {
    url = "https://nithya-reddych.github.io/recipe-app/calories.php"

    queryParams = {}
    for (i = 0; i < ingredients.length; i++) {
        key = "item" + i
        value = ingredients[i]
        if (i < weights.length) {
            value = weights[i] + " " + value
        }

        queryParams[key] = value
    }
    
    queryString = new URLSearchParams(queryParams).toString()
    url = url + "?" + queryString

    cals = await fetch(url)
        .then((res) => {return res.json()})

    return cals
}   
