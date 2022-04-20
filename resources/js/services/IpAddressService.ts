import HttpService from "./HttpService.ts";

export default new class {
    all() {
        let axios = HttpService.getInstance();
        let api_url = process.env.app.api_url + 'ip-addresses'; 
        let result = axios.get(api_url);

        return result;
    }

    create(data) {
        let axios = HttpService.getInstance();
        let api_url = process.env.app.api_url + 'ip-addresses'; 
        let result = axios.post(api_url, data);

        return result;
    }

    update(id, data) {
        let axios = HttpService.getInstance();
        let api_url = process.env.app.api_url + 'ip-addresses/' + id; 
        let result = axios.post(api_url, data);

        return result;
    }
}