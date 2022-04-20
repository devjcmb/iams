import axios from 'axios';

export default new class {
    getInstance() {
        let token = localStorage.getItem('token');

        let instance = axios.create({
            headers: {
                Authorization: `Bearer ${token}`
            }
        })

        return instance;
    };

}