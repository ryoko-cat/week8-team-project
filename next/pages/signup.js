import axios from "axios";
import { useState } from "react";
import Link from 'next/link';
import Router from 'next/router';

export default function Signup() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");

  function handleSubmit(e) {
    e.preventDefault();
    const data = {
      name: name,
      email: email,
      password: password,
      role: 2, // デフォルト値を2
    };
    axios.post(`http://localhost:8000/api/signup`, data, { withCredentials: true })
    .then((res) => {
      console.log(res);
      Router.push(`/login`)
    })
    .catch((error) => {
      console.log(error);
    });
  }

  return (
    <>
    <form>
      <div>
        <label>name:</label>
        <input type="name" onChange={(e) => setName(e.target.value)}/>
      </div>
      <div>
        <label>email:</label>
        <input type="email" onChange={(e) => setEmail(e.target.value)}/>
      </div>
      <div>
        <label>password:</label>
        <input type="password"  onChange={(e) => setPassword(e.target.value)}/>
      </div>
        <button onClick={handleSubmit}>新規登録</button>
      <div>
        <Link href="/login"><a>ログインはこちら</a></Link>
      </div>
    </form>
    </>
  )
}