import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';
import { Router } from '@angular/router';
import { CompraService } from '../services/compra.service';
import { AxiosContextService } from 'src/server/axiosContext.server';
import { ICompra } from '../tela-compra/tela-compra.page';
import { IGiftCard } from '../home/IGiftCardHome';

@Component({
  selector: 'app-tela-pagamento',
  templateUrl: './tela-pagamento.page.html',
  styleUrls: ['./tela-pagamento.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, YCardErrorComponent]
})
export class TelaPagamentoPage implements OnInit {
  mostrarErro = false;
  mensagemErro = '';
  compra: ICompra = {
    nome: '',
    id_company: 0,
    id_value: 0,
    value: 0,
    quantidade: 1,
    valorTotal: 0
  };

  constructor(private router: Router, private compraContext: CompraService, private axiosContext: AxiosContextService) { }
  private axios = this.axiosContext.getAxiosInstance();
  ngOnInit() {
   const compra = this.compraContext.getCompra();
  if (compra) {
    this.compra = compra; // <-- esta linha estava faltando!
    console.log('Dados da compra:', this.compra);
    this.quantidade = this.compra.quantidade;

  }
  }
  metodoSelecionado: string = 'cartao';
  cartao = {
    numero: '',
    nome: '',
    validade: '',
    cvv: ''
  };

  gift: IGiftCard = {
    id: 0,
    name: '',
    desc: '',
    image_url: '',
    company: ''
  };
  
  quantidade = 1;

  async carregarGifts(id: number) {
    try {

      const response = await this.axios.get(`/giftcards/${this.compra.id_company}`);
      this.gift = response.data;
    } catch (error) {
      console.error('Erro ao carregar gift:', error);
    }
  }


  finalizarCompra() {
    if( !this.cartao.cvv || !this.cartao.nome || !this.cartao.numero || !this.cartao.validade){
      this.mensagemErro = "Preencha todos os campos corretamente";
        this.mostrarErro = true;
        return;
    }

    try{
      //chamar post de compra
      this.router.navigate(['/home']);
    }catch(error){

    }
  }
  fecharErro() {
    this.mostrarErro = false;
  }
  navegarHome() {

    this.router.navigate(['/home']);
  }
}
