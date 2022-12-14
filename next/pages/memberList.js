import Head from 'next/head'
import axios from "axios";
import Link from 'next/link';

export async function getServerSideProps() {
  const res = await axios.get("http://nginx:80/api/member", {
  });
  const data = await res.data;

  return { 
      props: {
          data: data 
      },
  };
}

function roleChange(role, number) {
    let roleAfter = "";
    if(role === "1"){
        roleAfter = "2"
    } else if (role === "2") {
        roleAfter = "1"
    }

    const data = {
      "role": roleAfter
    };
    axios.put(`http://localhost:8000/api/member/${number}`, data)
    .then((res) => {
      console.log(res);
    })
    .catch((error) => {
      console.log(error);
    });
  }

const Home = ({ data }) => {
   console.log(data)
   console.log(typeof data[0].role) 

    return (
    <div>
      <Head>
        <title>Create Next App</title>
        <meta name="description" content="Generated by create next app" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

     <main>
        MEMBER LIST<br/><br/>
        <Link href={"/admin"}>管理者HOMEへ</Link><hr/>
     <div>
        {data.map((d) => (
        <ul key={d.id}>
            name: {d.name}<br/><br/>email: {d.email}<br/><br/>role: {d.role}<br/><br/>
            <button onClick={() => roleChange(d.role, d.id)}>ロールの変更</button><hr/>
        </ul>
        ))}
    </div>
      </main> 
    </div>
  )
}


export default Home 