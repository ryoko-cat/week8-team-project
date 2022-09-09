import axios from "axios";
import React,{ useState } from "react";
import Link from "next/link";

export default function ItemPost() {
    const [item, setitem] = useState("");
    const [description, setdescription] = useState("");
    const [category, setcategory] = useState("");
    const [period, setperiod] = useState("");

    function handleSubmit() {
        const data = {
            "title":item,
            "description":description,
            "category_id":category,
            "period_id":period,
            "status":0
        };

        axios.post(`http://127.0.0.1:8000/api/items`, data, { withCredentials: true })
          .then((res) => {
            console.log(res);
          })
      }

    return(
        <div>
            <h1>管理者ページ</h1>
            <h2>本の追加</h2>
            <br></br>
            <div>
            <label>題名</label>
            <input type="title" onChange={(e) => setitem(e.target.value)}/>
            <br></br>
            <br></br>
            <label>説明</label>
            <input type="description" onChange={(e) => setdescription(e.target.value)}/>
            <br></br>
            <br></br>
            <label>用途</label>
            <select value={category} onChange={(e) => setcategory(e.target.value)}>
                <option value="A">用途</option>
                <option value={1}>雑誌</option>
                <option value={2}>コミック</option>
                <option value={3}>文庫</option>
                <option value={4}>実用書</option>
                <option value={5}>児童書・学習参考書</option>
                <option value={6}>専門書</option>
                <option value={7}>その他</option>
            </select>
            <br></br>
            <br></br>
            <label>期限</label>
            <select value={period} onChange={(e) => setperiod(e.target.value)}>
                <option value="A">期間</option>
                <option value={1}>7日間</option>
                <option value={2}>14日間</option>
                <option value={3}>21日間</option>
                <option value={4}>28日間</option>
            </select>
            <br></br>
            <br></br>
            <button onClick = {handleSubmit}>追加！</button>
            </div>
            <hr/>
            <Link href={"/adminItemList"}>すべての本の貸出状況</Link>
            <br></br>
            <Link href={"/memberList"}>利用者一覧</Link>
        </div>       
    )
}