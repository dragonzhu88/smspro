import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor( private http: HttpClient) { }

  getTest (): Observable<any> {
    return this.http.get<any>('http://localhost/admin/index.php/commands/index')
  }

  sendSms (params): Observable<any> {
    return this.http.post<any>('http://localhost/admin/index.php/commands/smsSend',params)
  }

  sendUSSD (params): Observable<any> {
    return this.http.post<any>('http://localhost/admin/index.php/commands/sendUSSD',params)
  }

  receiveMSG (): Observable<any> {
    return this.http.get<any>('http://localhost/admin/index.php/commands/receiveMSG')
  }

}
