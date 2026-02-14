import axios from 'axios';

const API_URL = 'http://localhost:8000';

export const login = async (email, password) => {
    const response = await axios.post(`${API_URL}/api/login`, { email, password });
    localStorage.setItem('token', response.data.access_token);
    return response.data;
};

export const logout = async () => {
    const token = localStorage.getItem('token');
    await axios.post(
        `${API_URL}/api/logout`,
        {},
        {
            headers: { Authorization: `Bearer ${token}` },
        },
    );
    localStorage.removeItem('token');
};

export const loginWithMicrosoft = () => {
    window.location.href = `${API_URL}/auth/microsoft`;
};
