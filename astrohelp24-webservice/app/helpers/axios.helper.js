const axios=require('axios');

const makeRequest = async (method='get',url,headers,data) => {

    const config = {
        method: method,
        url: url,
        headers: headers,
        data:data
    }

    let res = await axios(config)

    return res
    // console.log(res.request._header);
}

// const makeRequest = (method='get',url,headers,data) => {
//     return new Promise(async (resolve,reject)=>{
//         await axios({
//             method: method,
//             url: url,
//             headers: headers,
//             data:data
//         }).then((response)=>resolve(response.data)).catch((e)=>reject(alert(e.message)))
//     })
// }

const ant_media_server_req = async () => {
    const config = {
        method: "PUT",
        url: "https://astrohelp24.com:5443/LiveApp/rest/v2/broadcasts/conference-rooms/broadcast1624335583025/add",
        headers: {
            'Content-Type':'application/json'
        },
        data:{
            room_id:"broadcast1624335583025",
            streamId:"djfdjdjdjdjdjerjrotnpf"
        }
    }

    let res = await axios(config)

    const data = res.data;
    return data;
}





const generateDynamicLink = async (link, andoidPackageName = "", IosPackageName = "") => {
    const url = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyCclp8O4gDizbZFvRBxVlTRp1Slyf8LFig';

    let dyLink = "https://astrohelp24.page.link?link="+encodeURIComponent(link)
    if(andoidPackageName != "") {
        dyLink = dyLink+"&apn="+andoidPackageName
    }
    if(IosPackageName != "") {
        dyLink = dyLink+"&ibi="+IosPackageName
    }
    const config = {
        method: "POST",
        url: url,
        headers: {
            'Content-Type': 'application/json'
        },
        data: {
            longDynamicLink: dyLink,
        }
    }

    let res = await axios(config)

    const data = res.data;
    return data;
}

module.exports = {
    makeRequest,
    ant_media_server_req,
    generateDynamicLink
}