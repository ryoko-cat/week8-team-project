import Head from 'next/head'
import axios from "axios";
import { useState } from 'react';

export async function getServerSideProps() {

const rentals = await fetch("http://nginx:80/api/rentalList");//最後にmember_idつけてその人だけの情報が取れるように?
const rental = await rentals.json();

const items = await fetch("http://nginx:80/api/items");
const item = await items.json();

const periods = await fetch("http://nginx:80/api/period");
const period = await periods.json();

  return { 
      props: {
          rental, item, period
      },
  };
}


const Home = ( data ) => {
console.log(1)
console.log(data);
    const rentalLists = data.rental.rentalLists
    console.log("rentalLists",rentalLists);
    const items = data.item.items;
    console.log("items",items);
    const days = data.period.periods
    console.log("days",days);

    const rentalResult= []; //rentalListのitem_id
    rentalLists.forEach(rentalList => rentalResult.push(rentalList.item_id));
    console.log("rentalResult",rentalResult);

    const itemIds = [];//itemテーブルのid
    items.forEach(item => itemIds.push(item.id));
    console.log(itemIds);

    const itemResult = [];//itemテーブルのタイトル
    items.forEach(item => itemResult.push(item.title));
    console.log("itemResult",itemResult);

    const itemStatus = [];//status
    items.forEach(item => itemStatus.push(item.status));
    console.log(itemStatus);

    const itemPeriod = [];//itemテーブルの期間id
    items.forEach(item => itemPeriod.push(item.period_id));
    console.log("itemPeriod",itemPeriod);


    const periodResult = [];//貸出期間
    days.forEach(day => periodResult.push(day.id));
    console.log("periodResult",periodResult);

    const periodDaysResult = [];//貸出期間
    days.forEach(day => periodDaysResult.push(day.days));
    console.log("periodDaysResult",periodDaysResult);

    //貸出期間を表示するか???
    function formatDate(dt) {
        const y = dt.getFullYear();
        const m = ('00' + (dt.getMonth()+1)).slice(-2);
        const d = ('00' + dt.getDate()).slice(-2);
        return (y + '/' + m + '/' + d);
      }


    async function backBook (id) {
        await fetch(`http://localhost:8000/api/backItem/${id}`,{
            mode:'cors',
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'User-Agent': '*',
            }, 
            body:JSON.stringify({
                'back_date':formatDate(new Date()),
                "status": false
            })
         })
          .then(() => window.location.reload())  
    }

    const limit =items.map((item, index) => {
        for(let i= 0; i<itemPeriod.length; i++){
            if(periodResult[i] === item.period_id){
                return (
                    <p key={index} className='bookinfo'>{periodDaysResult[i]}日</p>
                )
            }
        }
    })

    const lentDay = rentalLists.map(rentalList => {
        let dt = new Date(rentalList.lending_date)
        //console.log("dt", dt)
        dt.setDate(dt.getDate() + 10);
        dt= dt.toLocaleDateString();
        console.log("dt", dt)
        // console.log("dt", dt.toLocaleDateString())
        console.log("dt", typeof dt)
    })

    console.log("lentDay", lentDay)
    const day = new Date();
    day.setDate(day.getDate() + 1);
    console.log("day", day)

    return (
    <div>
      <Head>
        <title>MY PAGE</title>
      </Head>

     <main>
        <div>
            <p className='title'>借りている本一覧</p>
            <div className='clum'>
                <p className='bookinfo'>借りている本</p>
                <p className='bookinfo'>借りた日</p>
                <p>貸出可能期間</p>
            </div>
            {rentalLists.map((rentalList, index) => {
                if(rentalList.back_date === null){
                    const limit =items.map((item, index) => {
                        for(let x= 0; x<itemPeriod.length; x++){
                            if(periodResult[x] === item.period_id){
                                return (
                                    <p key={index} className='bookinfo'>{periodDaysResult[x]}日</p>
                                )
                            }
                        }
                    })                
                    for(let i= 0; i<itemResult.length; i++){
                        if(rentalList.item_id === itemIds[i]){
                            // let dt = new Date(rentalList.lending_date)
                            // dt.setDate(dt.getDate() +periodDaysResult[i]);
                            // dt= dt.toLocaleDateString();
                            // console.log("dt", dt)
                                return (
                                    <div className='aboutBook' key={index}>
                                        <p className='bookinfo'>{itemResult[i]}</p>
                                        <p className='bookinfo'>貸出日: {rentalList.lending_date}</p>
                                        {limit[0]}
                                        {/* {dt} */}
                                        {console.log(typeof rentalList.lending_date)}
                                        {console.log(new Date(rentalList.lending_date))}
                                        <button type='button' className='backbtn' onClick={() => backBook(rentalList.id)}>返却</button>
                                </div>
                            )
                        }
                    }
                }
            })}
        </div>
      </main> 
    </div>
  )
  
}

export default Home