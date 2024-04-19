// Calls api for calorie counts
// Returns promise for an associative array where key is food name and value is calorie count.
// 
// ingredients = array of food names eg ["Chicken", "Rice", "Falafel"]
// optional weights = array of strings representing weights eg ["20 oz", "2 lbs", "4 cups"]
// optional callBack = function to run when call to api is done. 
//     callBack function takes an associative array where key is food name and value is calorie count.
async function calories(ingredients, weights = [], callBack = null) {
    url = "https://api.api-ninjas.com/v1/nutrition?query="
    ak = "Xw8Y9UPSEz9fURhT0KiM9g==9fGe6d6ky2AnLE4O"

    queries = []
    for (i = 0; i < ingredients.length; i++) {
        if (i < weights.length) {
            query = weights[i] + " "
        } else {
            query = ""
        }

        query += ingredients[i]
        queries.push(query)
    }
    
    queryString = queries.join(" and ")
    url = url + queryString

    data = await fetch(url, {headers: {"X-Api-Key":ak}})
        .then((res) => {return res.json()})

    cals = {}
    data.forEach( (food) => {
        f_name = food["name"]
        f_cal = food["calories"]
        cals[f_name] = f_cal}
    )
    
    if (callBack) {
        callBack(cals)
    }
    
    return cals
}   

