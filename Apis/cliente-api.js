/* Encabezados de nuestras peticiones */
let config = {
    headers:new Headers(
        {"Content-Type": "application/json; charset:utf8"}
    ),
};

/* Crear la funcion encargada de hacer el "POST" */

const posData = async(data)=>{
    config.method = "POST";
    config.body = JSON.stringify(data);
    let res = await ( await fetch("../",config)).text();
    return res;
}
/* Crear la funcion encargada de hacer el "PUT" (actualizacion de data)*/
const putData = async(data)=>{
    config.method = "PUT"; //jet?
    config.body = JSON.stringify(data);
    let res = await ( await fetch("../",config)).json();
    return res;
}

/* Crear la funcion encargada de hacer el "DELETE" (eliminacion de data)*/
const deleteData = async(data)=>{
    config.method = "DELETE";
    let res = await ( await fetch("../",config)).json();
    console.log(res);
}

export {
    posData,
    putData,
    deleteData
}