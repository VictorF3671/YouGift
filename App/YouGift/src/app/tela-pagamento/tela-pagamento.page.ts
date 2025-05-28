import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';
import { Router } from '@angular/router';
import { CompraService } from '../services/compra.service';
import { AxiosContextService } from 'src/server/axiosContext.server';

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
  constructor(private router: Router, private compraContext: CompraService, private axiosContext: AxiosContextService) { }
   private axios = this.axiosContext.getAxiosInstance();
  ngOnInit() {
    const compra = this.compraContext.getCompra();
  if (compra) {
    console.log('Dados da compra:', compra);
  }
}

metodoSelecionado: string = 'cartao';
cartao = {
  numero: '',
  nome: '',
  validade: '',
  cvv: ''
};

gift = {
  nome: 'Netflix 50',
  valor: 50
};

quantidade = 1;

async carregarGifts(id: number) {
  try {
    const response = await this.axios.get(`/giftcards/${id}`);
    this.gift = response.data;
  } catch (error) {
    console.error('Erro ao carregar gift:', error);
  }
}

finalizarCompra() {
  const total = this.gift.valor * this.quantidade;

  // Chamada da API, geração dos seriais, envio por e-mail etc.
}
  fecharErro() {
    this.mostrarErro = false;
  }
   navegarHome() {
   
    this.router.navigate(['/home']);
  }
}
