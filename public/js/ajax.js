export default class AjaxRequest {
    static sendRequest(data, url) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('--Server Response Success--', data); // For Logs
                resolve(data);
            })
            .catch(error => {
                console.log('--Server Response Error--', error); // For Logs
                reject(error);
            });
        });
    }

    static sendFormRequest(data, url) {
        return new Promise((resolve, reject) => {
            fetch(url, {
                method: 'POST',
                body: data,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('--Server Response Success--', data); // For Logs
                resolve(data);
            })
            .catch(error => {
                console.log('--Server Response Error--', error); // For Logs
                reject(error);
            });
        });
    }
}