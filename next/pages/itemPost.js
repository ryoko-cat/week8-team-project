import axios from "axios";
import React,{ useState } from "react";

export default function ItemPost() {
    const [item, setitem] = useState("");
    const [description, setdescription] = useState("");
    const [category, setcategory] = useState("");
    const [period, setperiod] = useState("");
    const [status, setstatus] = useState("");

    function handleSubmit(e) {
        e.preventDefault();
        const data = {
            "title":item,
            "description":description,
            "category_id":category,
            "period_id":period,
            "status":status
        };
        axios.post(`http://127.0.0.1:8000/api/items`, data)
        .then((res) => {
          console.log(res);
        })
        .catch((error) => {
          console.log(error);
        });
      }

    return(
        <div>
            <h1 >item追加</h1>
            <br></br>
            <div>
            <label>タイトル</label>
            <select value={item} onChange={(e) => setitem(e.target.value)}>
                <option value="A">本</option>
                <option value={"TOEIC"}>TOEIC</option>
            </select>
            <br></br>
            <br></br>
            <label>説明</label>
            <select value={description} onChange={(e) => setdescription(e.target.value)}>
                <option value="A">金額</option>
                <option value={"単語帳"}>単語帳</option>
            </select>
            <br></br>
            <br></br>
            <label>用途</label>
            <select value={category} onChange={(e) => setcategory(e.target.value)}>
                <option value="A">用途</option>
                <option value={4}>4</option>
            </select>
            <br></br>
            <br></br>
            <label>期限</label>
            <select value={period} onChange={(e) => setperiod(e.target.value)}>
                <option value="A">期限</option>
                <option value={4}>4</option>
            </select>
            <br></br>
            <br></br>
            <label>状態</label>
            <select value={status} onChange={(e) => setstatus(e.target.value)}>
                <option value="A">状態</option>
                <option value={0}>貸出可</option>
            </select>
            <br></br>
            <br></br>
            <button onClick = {handleSubmit}>追加！</button>
            </div>
        </div>       
    )
}