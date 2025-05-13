import { Injectable } from '@angular/core';
import axios, { AxiosInstance } from 'axios';

@Injectable({
  providedIn: 'root'
})
export class AxiosContextService {
  private axiosInstance: AxiosInstance;

  constructor() {
    this.axiosInstance = axios.create({
      baseURL: '', // Coloque aqui sua URL base
      headers: {
        'Content-Type': 'application/json'
      }
    });
  }

  getAxios() {
    return this.axiosInstance;
  }
}