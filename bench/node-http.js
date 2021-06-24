const http = require('http')

let port = process.env.port | 3000

//http.globalAgent.maxSockets = 200000

http.createServer(app).listen(port, () => {
    console.log(`server is listening ${port}`)
})

//let number = 0
function app(req, res) {
	//console.log(++number)
    res.end("Hello Node")
}

