import { Injectable } from '@angular/core';
import { ICompra } from '../tela-compra/tela-compra.page';

@Injectable({
  providedIn: 'root'
})
export class CompraService {

  private compra: ICompra | null = null;

  setCompra(compra: ICompra) {
    this.compra = compra;
  }

  getCompra(): ICompra | null {
    return this.compra;
  }

  clear() {
    this.compra = null;
  }
}

