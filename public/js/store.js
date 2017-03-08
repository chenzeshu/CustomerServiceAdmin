function saveToLocal(key, value) {
    let user = window.localStorage.__user__; // 用户地址空间
    if (!user){
        user = {}
    }else{
        user = JSON.parse(user)
    }
    user[key] = value

    window.localStorage.__user__ = JSON.stringify(user)
}

function loadFromLocal(key, def) {
    let user = window.localStorage.__user__
    if (!user){
        return def
    }
    user = JSON.parse(user)
    let ret = user[key]
    return ret || def
}