import React from "react"
import Style from "./style.css"
import Navbar from "./components/Navbar"
import Main from "./components/Main"

export default function App() {
    return (
        <div className="container">
            <Navbar/>
            <Main/>
        </div>
    )
}
