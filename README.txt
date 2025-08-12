A noite mais escura - projeto PHP + MySQL
Gerado em 2025-08-11T23:51:17.808454Z

Como usar:
1) Coloque os arquivos em um servidor com PHP 7.4+ e MySQL.
2) Edite 'db.php' com as credenciais do seu banco de dados.
3) Execute o SQL em 'install.sql' para criar o banco e a tabela:
   mysql -u root -p < install.sql
4) Abra 'index.php' no navegador.

Arquivos:
- index.php         -> Página principal, galeria e lista de comentários.
- submit_comment.php-> Processa e grava comentários.
- db.php            -> Conexão PDO (configure suas credenciais).
- install.sql       -> Script para criar banco e tabela.
- images/           -> 5 imagens placeholder em SVG.

Notas de segurança e melhorias possíveis:
- Esta versão usa proteção básica (prepared statements). Para produção, adicione CSRF tokens, validação mais robusta, escaping no server-side e rate-limiting.
- Considere adicionar paginação dos comentários e moderação (aprovação).
