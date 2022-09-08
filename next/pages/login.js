import axios from "axios";
import { useState } from "react";

export default function Signup() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  function handleClick(e) {
    e.preventDefault();
    const data = {
      email: email,
      password: password,
    };
    axios
      .get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true })
      .then((res) => {
        // ログイン処理
        axios
          .post(`http://localhost:8000/api/login`, data, { withCredentials: true })
          .then((res) => {
            console.log(res.data);
            // レスポンスがOKなら別ページにリダイレクトさせる（roleが1なら管理者、2ならTOPページ）
          })

      })
  }

  // SPA認証済みではないとアクセスできないAPI
  const handleUserClick = () => {
    axios.get('http://localhost:8000/api/user', { withCredentials: true }).then((response) => {
      console.log(response.data)
    })
  }

  return (
    <>
    <form>
      <div>
        <label>email</label>
        <input type="email" onChange={(e) => setEmail(e.target.value)}/>
      </div>
      <div>
        <label>password</label>
        <input type="password"  onChange={(e) => setPassword(e.target.value)}/>
      </div>
      <div>
        <button onClick={handleClick}>ログイン</button>
      </div>
      <div>
        <button onClick={handleUserClick}>ユーザー情報を取得</button>
      </div>
    </form>
    </>
  )
}