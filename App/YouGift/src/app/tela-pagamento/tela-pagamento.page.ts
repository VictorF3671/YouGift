import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { YCardErrorComponent } from '../components/ycard-error/ycard-error.component';
import { Router } from '@angular/router';

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
  constructor(private router: Router) { }

  ngOnInit() {
  }
  metodoSelecionado: 'cartao' | 'pix' = 'cartao';

  dadosCartao = {
    numero: '',
    nome: '',
    validade: '',
    cvv: ''
  };
  fecharErro() {
    this.mostrarErro = false;
  }
   navegarHome() {
   
    this.router.navigate(['/home']);
  }
}
