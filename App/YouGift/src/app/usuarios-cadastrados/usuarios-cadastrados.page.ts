import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { IonicModule } from '@ionic/angular';
import { CommonModule } from '@angular/common';
import { AxiosContextService } from 'src/server/axiosContext.server';

export interface IUsuario {
  id: number;
  cpf: string;
  nome: string;
  email: string;
  telefone: string;
  }

@Component({
  selector: 'app-usuarios-cadastrados',
  templateUrl: './usuarios-cadastrados.page.html',
  styleUrls: ['./usuarios-cadastrados.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule]
})
export class UsuariosCadastradosPage implements OnInit {
  users: IUsuario[] = [
    {
      id: 0,
      cpf: '',
      nome: '',
      email: '',
      telefone: '',
    }
  ]; 
  private axios = this.axiosContext.getAxiosInstance();
  constructor(private router: Router, private axiosContext: AxiosContextService) {}

  ngOnInit() {
    this.carregarUsuarios();
  }

  
  async carregarUsuarios() {
    try{
    const response =  await this.axios.get('/usuario/listar-todos')
    this.users = response.data     
    } catch (error) {
      console.error('Erro ao carregar usuários da API, usando dados mockados.', error);
      this.users = [
        {
          id: 1,
          cpf: '123.456.789-00',
          nome: 'João da Silva',
          email: 'joao@example.com',
          telefone: '(11) 98765-4321'
        },
        {
          id: 2,
          cpf: '987.654.321-00',
          nome: 'Maria Oliveira',
          email: 'maria@example.com',
          telefone: '(21) 91234-5678'
        },
        {
          id: 3,
          cpf: '111.222.333-44',
          nome: 'Carlos Souza',
          email: 'carlos@example.com',
          telefone: '(31) 99876-5432'
        }
      ];
    }
  }
  

  
   
  
}