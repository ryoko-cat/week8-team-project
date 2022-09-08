import axios from "axios";
import { useState } from "react";

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
    axios.post(`http://localhost:8000/api/signup`, data)
    .then((res) => {
      console.log(res);
    })
    .catch((error) => {
      console.log(error);
    });
  }

  return (
    <>
    <form>
        <label>name:</label>
        <input type="name" onChange={(e) => setName(e.target.value)}/>
        <label>email:</label>
        <input type="email" onChange={(e) => setEmail(e.target.value)}/>
        <label>password:</label>
        <input type="password"  onChange={(e) => setPassword(e.target.value)}/>
        <button onClick={handleSubmit}>新規登録</button>
    </form>
    </>
  )
}