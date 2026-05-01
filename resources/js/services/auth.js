import api from '../api/api';
export const login = async (email,password) => {
    const res = await api.post('/login',{email,password});
    localStorage.setItem('token',res.data.access_token);
    return res.data;
};
export const getUser = async () => {
    const res = await api.get('/me');
    localStorage.setItem('user',JSON.stringify(res.data));
    return res.data;
};
export const logout = async() => {
    await api.post('/logout');
    localStorage.removeItem('token');
    localStorage.removeItem('user');
};