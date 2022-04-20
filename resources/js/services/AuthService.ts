import HttpService from "./HttpService.ts";

export default new class {
    login(data) {
        let axios = HttpService.getInstance();
        let api_url = process.env.app.api_url + 'auth/login'; 
        let result = axios.post(api_url, data);

        return result;
    };

    logout() {
        let axios = HttpService.getInstance();
        let api_url = process.env.app.api_url + 'auth/logout'; 
        let result = axios.post(api_url);

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