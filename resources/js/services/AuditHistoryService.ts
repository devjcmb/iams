import HttpService from "./HttpService.ts";

export default new class {
    all() {
        let axios = HttpService.getInstance();
        let api_url = process.env.app.api_url + 'audit-history'; 
        let result = axios.get(api_url);

        return result;
    };
}