# Montik Mini ERP

Mini ERP Laravel com suporte a:
- Cadastro de produtos e variações de estoque
- Carrinho de compras com frete inteligente
- Aplicação de cupons válidos com regras de subtotal
- Integração com ViaCEP
- Envio de e-mail de confirmação de pedido
- Webhook para atualização/cancelamento de status
- Seeders e factories para dados simulados
- Ambiente Docker com Laravel + MySQL

---

## 🚀 Executando com Docker

### Pré-requisitos
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)

### Clone o projeto
```bash
git clone https://github.com/famorim88/montik-minierp-test.git
cd montik-minierp-test
```

### Copie e edite seu arquivo `.env`
```bash
cp .env.example .env
```
Ajuste se necessário:
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=montik
DB_USERNAME=montik_user
DB_PASSWORD=montik_pass
```

### Inicie o ambiente
```bash
docker-compose up --build
```

Acesse: [http://localhost:8000](http://localhost:8000)

---

## 📦 Recursos

### Produtos
- Cadastro com nome, preço e múltiplas variações (estoque por variação)

### Carrinho
- Gerenciado por sessão
- Calcula subtotal + frete automaticamente:
  - R$52 a R$166,59 → Frete R$15
  - Acima de R$200 → Frete grátis
  - Caso contrário → Frete R$20

### Checkout
- Validação de endereço por CEP (ViaCEP)
- Cupom (com validade e mínimo de carrinho)
- Envio de e-mail (mailable personalizado)

### Webhook
Endpoint:
```
POST /webhook/order
```
Body JSON:
```json
{
  "id": 1,
  "status": "cancelled"
}
```
Cancela ou atualiza pedido pelo ID

---

## 🧪 Seeders e Factories

Gere dados simulados:
```bash
docker exec -it montik_app php artisan migrate:fresh --seed
```
- 10 pedidos
- 5 cupons com regras e validade

---

## 🗃 Estrutura
```
├── app
│   ├── Http/Controllers
│   ├── Mail/OrderConfirmation.php
│   ├── Models/{Product, Stock, Order, Coupon}.php
├── database
│   ├── factories/{OrderFactory, CouponFactory}.php
│   ├── seeders/{OrderSeeder, CouponSeeder}.php
├── resources
│   └── views/{products, orders, emails}
├── docker-compose.yml
├── Dockerfile
├── .env
```

---

## ✨ Créditos
Desenvolvido por Felipe Marcel Amorim como parte de avaliação técnica.

Repositório: [github.com/famorim88/montik-minierp-test](https://github.com/famorim88/montik-minierp-test)
