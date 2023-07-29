import http from "@/http-common";

/* eslint-disable */
class ExpenseDataService {
    getAll(): Promise<any> {
        return http.get("/expenses");
    }

    get(id: any): Promise<any> {
        return http.get(`/expenses/${id}`);
    }

    create(data: any): Promise<any> {
        return http.post("/expenses", data);
    }

    update(id: any, data: any): Promise<any> {
        return http.put(`/expenses/${id}`, data);
    }

    delete(id: any): Promise<any> {
        return http.delete(`/expenses/${id}`);
    }

    deleteAll(): Promise<any> {
        return http.delete(`/expenses`);
    }
}

export default new ExpenseDataService();
