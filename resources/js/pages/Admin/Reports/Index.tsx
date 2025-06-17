import { Head, useForm } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { TipoUser, Workplace } from '@/types';

interface Props {
    tipos_user: TipoUser[];
    workplaces: Workplace[];
}

export default function Reports({ tipos_user, workplaces }: Props) {
    const usersForm = useForm({
        tipo_user_id: '',
        data_registo_de: '',
        data_registo_ate: '',
    });

    const workplacesForm = useForm({
        data_criacao_de: '',
        data_criacao_ate: '',
        visibilidade: '',
    });

    const quadrosForm = useForm({
        workplace_id: '',
        data_criacao_de: '',
        data_criacao_ate: '',
    });

    const generatePdfUrl = (routeName: string, data: any) => {
        const url = new URL(route(routeName));
        Object.keys(data).forEach(key => {
            if (data[key] && data[key] !== 'all') {
                url.searchParams.append(key, data[key]);
            }
        });
        return url.toString();
    };

    const handleUsersSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const url = generatePdfUrl('admin.reports.users-pdf', usersForm.data);
        window.open(url, '_blank');
    };

    const handleWorkplacesSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const url = generatePdfUrl('admin.reports.workplaces-pdf', workplacesForm.data);
        window.open(url, '_blank');
    };

    const handleQuadrosSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        const url = generatePdfUrl('admin.reports.quadros-pdf', quadrosForm.data);
        window.open(url, '_blank');
    };

    return (
        <AdminLayout title="Relatórios">
            <Head title="Relatórios" />
            <div className="space-y-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Relatório de Utilizadores</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={handleUsersSubmit} className="space-y-4">
                            <div>
                                <Label htmlFor="tipo_user_id">Tipo de Utilizador</Label>
                                <Select
                                    value={usersForm.data.tipo_user_id}
                                    onValueChange={(value) => usersForm.setData('tipo_user_id', value)}
                                >
                                    <SelectTrigger id="tipo_user_id">
                                        <SelectValue placeholder="Todos" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">Todos</SelectItem>
                                        {tipos_user.map((tipo) => (
                                            <SelectItem key={tipo.id} value={tipo.id.toString()}>
                                                {tipo.vc_nome}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                            </div>
                            <div>
                                <Label htmlFor="data_registo_de">Data de Registo De</Label>
                                <Input
                                    id="data_registo_de"
                                    type="date"
                                    value={usersForm.data.data_registo_de}
                                    onChange={(e) => usersForm.setData('data_registo_de', e.target.value)}
                                />
                            </div>
                            <div>
                                <Label htmlFor="data_registo_ate">Data de Registo Até</Label>
                                <Input
                                    id="data_registo_ate"
                                    type="date"
                                    value={usersForm.data.data_registo_ate}
                                    onChange={(e) => usersForm.setData('data_registo_ate', e.target.value)}
                                />
                            </div>
                            <Button type="submit">Gerar PDF</Button>
                        </form>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Relatório de Espaços de Trabalho</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={handleWorkplacesSubmit} className="space-y-4">
                            <div>
                                <Label htmlFor="data_criacao_de">Data de Criação De</Label>
                                <Input
                                    id="data_criacao_de"
                                    type="date"
                                    value={workplacesForm.data.data_criacao_de}
                                    onChange={(e) => workplacesForm.setData('data_criacao_de', e.target.value)}
                                />
                            </div>
                            <div>
                                <Label htmlFor="data_criacao_ate">Data de Criação Até</Label>
                                <Input
                                    id="data_criacao_ate"
                                    type="date"
                                    value={workplacesForm.data.data_criacao_ate}
                                    onChange={(e) => workplacesForm.setData('data_criacao_ate', e.target.value)}
                                />
                            </div>
                            <div>
                                <Label htmlFor="visibilidade">Visibilidade</Label>
                                <Select
                                    value={workplacesForm.data.visibilidade}
                                    onValueChange={(value) => workplacesForm.setData('visibilidade', value)}
                                >
                                    <SelectTrigger id="visibilidade">
                                        <SelectValue placeholder="Todos" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">Todos</SelectItem>
                                        <SelectItem value="publico">Público</SelectItem>
                                        <SelectItem value="privado">Privado</SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <Button type="submit">Gerar PDF</Button>
                        </form>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Relatório de Quadros</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={handleQuadrosSubmit} className="space-y-4">
                            <div>
                                <Label htmlFor="workplace_id">Espaço de Trabalho</Label>
                                <Select
                                    value={quadrosForm.data.workplace_id}
                                    onValueChange={(value) => quadrosForm.setData('workplace_id', value)}
                                >
                                    <SelectTrigger id="workplace_id">
                                        <SelectValue placeholder="Todos" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="all">Todos</SelectItem>
                                        {workplaces.map((workplace) => (
                                            <SelectItem key={workplace.id} value={workplace.id.toString()}>
                                                {workplace.vc_nome}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                            </div>
                            <div>
                                <Label htmlFor="data_criacao_de">Data de Criação De</Label>
                                <Input
                                    id="data_criacao_de"
                                    type="date"
                                    value={quadrosForm.data.data_criacao_de}
                                    onChange={(e) => quadrosForm.setData('data_criacao_de', e.target.value)}
                                />
                            </div>
                            <div>
                                <Label htmlFor="data_criacao_ate">Data de Criação Até</Label>
                                <Input
                                    id="data_criacao_ate"
                                    type="date"
                                    value={quadrosForm.data.data_criacao_ate}
                                    onChange={(e) => quadrosForm.setData('data_criacao_ate', e.target.value)}
                                />
                            </div>
                            <Button type="submit">Gerar PDF</Button>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AdminLayout>
    );
}