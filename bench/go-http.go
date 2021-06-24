package main

import (
    "fmt"
    "net/http"
    "log"
)

func hello(w http.ResponseWriter, r *http.Request) {
    fmt.Fprintf(w, "Hello go!") //這個寫入到 w 的是輸出到客戶端的
}

func main() {
    http.HandleFunc("/", hello) //設定存取的路由
    fmt.Println("running on port 9090")
    err := http.ListenAndServe(":9090", nil) //設定監聽的埠
    if err != nil {
        log.Fatal("ListenAndServe: ", err)
    }
}
