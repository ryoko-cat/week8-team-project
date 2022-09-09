import Head from 'next/head'
import axios from "axios";

export async function getServerSideProps() {
  
  const res = await axios.get("http://nginx:80/api/items", {
  });
  const data = await res.data;

  data.items.map((d)=> {
    if(d.status === 0){
        d.status = "貸出可"
    }
    else if(d.status === 1){
        d.status = "貸出中"
    }
  })

  data.items.map((d)=> {
    if(d.period_id === 1){
        d.period_id = "7日間"
    }
    else if(d.period_id === 2){
        d.period_id = "14日間"
    }
    else if(d.period_id === 3){
        d.period_id = "21日間"
    }
    else if(d.period_id === 4){
        d.period_id = "28日間"
    }
  })

  return { 
      props: {
          data: data 
      },
  };
}

let member = "";

axios.get('http://localhost:8000/api/users', { withCredentials: true }).then((res) => {
 member =  res.data.id
      console.log(res.data)
  })
  

const borrow = (id, status) => {
    const day = new Date()

    const formatDate = (current_datetime)=>{
        let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getDate();
        return formatted_date;
    }

    const list = {
        "item_id": id,
        "lending_date": formatDate(day),
        "back_date":null,
        "member_id": member 
    };

    axios.post(`http://localhost:8000/api/rentalList`, list,  { withCredentials: true })
    .then((res) => {
      console.log(res);
    })
    .catch((error) => {
      console.log(error);
    });
}

const Home = ({ data }) => {
  console.log(data.items)
    return (
    <div>
      <Head>
        <title>Create Next App</title>
        <meta name="description" content="Generated by create next app" />
        <link rel="icon" href="/favicon.ico" />
      </Head>

     <main>
        <h1>ALL ITEM LIST</h1><br/><br/>
        <button>MY PAGE</button>
     <div>
        {data.items.map((d) => (
        <ul key={d.id}>
            題名：{d.title}<br/><br/>説明：{d.description}<br/><br/>貸出状況：{d.status}<br/><br/>借りれる期間：{d.period_id}<br/><br/>
            <button onClick={() => borrow(d.id, d.status)} disabled={d.status === 1}>借りる</button><hr/>
        </ul>
        ))}
    </div>
      </main> 
    </div>
  )
}

export default Home 