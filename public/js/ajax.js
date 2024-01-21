
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
                console.log('--Server Response--',data); // For Logs
            })
            .catch(error => {
                reject(error);
            });
        });
    }
}
