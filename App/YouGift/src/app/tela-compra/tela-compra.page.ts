import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { CompraService } from '../services/compra.service';
import { IGiftCard } from '../home/IGiftCardHome';

export interface ICompra{
  id_company: number;
  id_value: number;
  value: number;
  quantidade: number;
  valorTotal: number
}

@Component({
  selector: 'app-tela-compra',
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  templateUrl: './tela-compra.page.html',
  styleUrls: ['./tela-compra.page.scss'],
})



export class TelaCompraPage {
 
 
  compra: ICompra = {
    id_company: 0,
    id_value: 0,
    value: 0,
    quantidade: 1,
    valorTotal: 0
  };

  gift: IGiftCard = {
  id: 0,
  name: '',
  desc: '',
  image_url: '',
  company: ''
};

values_gifts: any[] = [];

  valorSelecionado = 50;
  quantity = 1;

  constructor(private route: ActivatedRoute, private routerN: Router, private axiosContext: AxiosContextService,  private compraContext: CompraService) {}
  private axios = this.axiosContext.getAxiosInstance();

  ngOnInit() {
    const idParam = this.route.snapshot.paramMap.get('id');
    const id = Number(idParam);
    this.carregarGifts(id);
    this.carregarValues(id)
  }

 async carregarGifts(id: number) {
  try {
    const response = await this.axios.get(`/giftcards/${id}`);
    this.gift = response.data;
  } catch (error) {
    console.error('Erro ao carregar gift:', error);
  }
}

async carregarValues(id:number){
  try {
    const response = await this.axios.get(`/giftcard-values/${id}`);
    console.log(response.data)
    this.values_gifts = Array.isArray(response.data) ? response.data : [response.data];
    console.log('valores carregado:', this.values_gifts);
  } catch(error) {
    console.error('Erro ao carregar valores:', error);
    this.values_gifts = [];
  }
}

  selecionarValor(amount: number) {
    this.valorSelecionado = amount;
  }

  increase() {
    this.quantity++;
  }

  decrease() {
    if (this.quantity > 1) this.quantity--;
  }

  //quantidade
  //id Value
  //Value para fazer o calculo
  //id do gift
  buyNow() {
  const valueGift = this.values_gifts.find(v => Number(v.value) === Number(this.valorSelecionado));

  if (!valueGift) {
    console.error('Valor selecionado não encontrado nos valores disponíveis.');
    return;
  }

  this.compra = {
    id_company: this.gift.id, 
    id_value: valueGift.id,
    value: parseFloat(valueGift.value),
    quantidade: this.quantity,
    valorTotal: parseFloat(valueGift.value) * this.quantity
  };

  console.log('Compra gerada:', this.compra);

  // Salva no contexto para usar na próxima tela
  this.compraContext.setCompra(this.compra);

  // Navega para a tela de pagamento
  this.routerN.navigate(['/tela-pagamento']);
}

  
  navegarHome() {
    this.routerN.navigate(['/home']);
  }
}
