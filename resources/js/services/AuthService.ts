import axios from 'axios';

export default new class {
    login(query) {
        let api_url = process.env.app.api_url + 'auth/login'; 
        let result = axios.post(api_url, {'query': query});

        return result;
    };

    checkAuth() {
        let token = localStorage.getItem('token');

        if (token == '' || token === undefined || token === null) {
            return false;
        }

        return true;
    };
}